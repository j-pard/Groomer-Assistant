<?php

namespace App\Http\Livewire\Accounting;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Form extends LivewireForm
{
    public string $date;
    public string $activeMonth;
    public Collection $appointments;
    public array $availableStatus;
    public array $offStatus;

    // Header values
    public string $tva;
    public string $htva;
    public string $cumulated;
    public string $tvaCount;
    public string $htvaCount;
    public string $cumulatedCount;
    public string $remaining;
    public string $totalOfYearCount;

    // Modal
    public ?Appointment $appointment;
    public string $customerName;
    public string $petName;
    public string $modalTitle;

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m');
        $this->activeMonth = $this->date;
        $this->appointments = $this->getMonthAppointments();
        $this->availableStatus = Appointment::getStatusAsOptions();
        $this->offStatus = ['bank', 'payconiq', 'cancelled'];
        $this->makeCounts();
        $this->resetAppointment();
    }

    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function appointmentRules()
    {
        return [
            'appointment.pet_id' => 'required|numeric',
            'appointment.time' => 'string',
            'appointment.price' => 'nullable|numeric|min:0',
            'date' => 'string',
            'time' => 'string',
            'appointment.notes' => 'string|nullable',
            'appointment.status' => 'string',
            'appointment.force_cash' => 'boolean',
        ];
    }

    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function headerRules()
    {
        return [
            'tva' => 'required|numeric',
            'htva' => 'required|numeric',
            'cumulated' => 'required|numeric',
            'remaining' => 'required|numeric',
            'activeMonth' => 'required|date',
            'date' => 'string',
        ];
    }

    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function rules()
    {
        return array_merge($this->appointmentRules(), $this->headerRules());
    }

    /**
     * Render the component
     *
     * @return view
     */
    public function render()
    {
        return view('livewire.accounting.form');
    }

    /**
     * Save the model
     *
     * @return void
     */
    public function save()
    {
        $this->showMessage();
    }

    /**
     * Load previous month as $activeMonth
     *
     */
    public function previousMonth()
    {
        $this->date = Carbon::parse($this->activeMonth)->subMonth()->format('Y-m');
        $this->activeMonth = $this->date;
        $this->appointments = $this->getMonthAppointments();
        $this->makeCounts();
    }

    /**
     * Load next month as $activeMonth
     *
     */
    public function nextMonth()
    {
        $this->date = Carbon::parse($this->activeMonth)->addMonth()->format('Y-m');
        $this->activeMonth = $this->date;
        $this->appointments = $this->getMonthAppointments();
        $this->makeCounts();
    }

    /**
     * Load Appointment for modal
     *
     * @param string $id
     */
    public function loadAppointment(string $id)
    {
        $this->appointment = Appointment::where('appointments.id', $id)
            ->join('pets', 'appointments.pet_id', '=', 'pets.id')
            ->join('customers', 'appointments.customer_id', '=', 'customers.id')
            ->select(
                'appointments.id',
                'appointments.time',
                'appointments.price',
                'appointments.pet_id',
                'appointments.customer_id',
                'appointments.status'
            )
            ->first();

        $time = Carbon::parse($this->appointment->time);
        $this->date = $time->format('Y-m-d');
        $this->time = $time->format('H:i');
        $this->customerName = Customer::find($this->appointment->customer_id)->getFullName();
        $this->petName = $this->appointment->pet->name;

        $this->dispatchBrowserEvent('form-modal-loaded', ['modalId' => 'apptModal']);
    }

    /**
     * Reset modal variables
     *
     */
    public function resetAppointment()
    {
        $this->appointment = new Appointment();
        $this->customerName = '';
        $this->petName = '';
        $this->modalTitle = '';
    }

    /**
     * Return collection of all appointments of specified month
     *
     * @return Collection
     */
    private function getMonthAppointments(): Collection
    {
        $start = Carbon::parse($this->activeMonth)->firstOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::parse($this->activeMonth)->endOfMonth()->format('Y-m-d H:i:s');

        return Appointment::whereBetween('appointments.time', [$start, $end])
            ->join('pets', 'appointments.pet_id', '=', 'pets.id')
            ->join('customers', 'appointments.customer_id', '=', 'customers.id')
            ->select(
                'appointments.id',
                'appointments.time',
                'appointments.price',
                'appointments.pet_id',
                'appointments.customer_id',
                'appointments.status',
                'pets.name AS pet_name',
                'customers.lastname AS customer_lastname',
                DB::raw('DATE_FORMAT(appointments.time, "%d %b %H:%i") as formatted_date')
                )
            ->orderBy('appointments.time')
            ->get();
    }

    /**
     * Make counts of all appointments of specified month
     *
     */
    private function makeCounts()
    {
        $tvaQuery = $this->appointments->whereIn('status', Appointment::$tvaStatus);
        $this->tva = (clone $tvaQuery)->sum('price');
        $this->tvaCount = (clone $tvaQuery)->count();

        $htvaQuery = $this->appointments->where('status', 'private');
        $this->htva = (clone $htvaQuery)->sum('price');
        $this->htvaCount = (clone $htvaQuery)->count();

        $this->cumulated = $this->tva + $this->htva;
        $this->cumulatedCount = $this->tvaCount + $this->htvaCount;

        $totalOfYearQuery = Appointment::whereBetween('time', [
            Carbon::parse($this->activeMonth)->firstOfYear()->format('Y-m-d H:i:s'),
            Carbon::parse($this->activeMonth)->lastOfYear()->format('Y-m-d H:i:s')
        ]);
        $this->remaining = 25000 - (clone $totalOfYearQuery)->whereIn('status', Appointment::$tvaStatus)->sum('price');
        $this->totalOfYearCount = (clone $totalOfYearQuery)->whereNotIn('status', ['cancelled'])->count();
    }
}
