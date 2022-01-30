<?php

namespace App\Http\Livewire\Accounting;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Appointment;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Form extends LivewireForm
{
    public string $date;
    public string $activeMonth;
    public Collection $appointments;
    public array $appts;
    public array $apptsToUpdate = [];
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

    protected $listeners = ['apptUpdated' => 'apptUpdated'];

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
    protected function rules()
    {
        return [
            'tva' => 'required|numeric',
            'htva' => 'required|numeric',
            'cumulated' => 'required|numeric',
            'remaining' => 'required|numeric',
            'activeMonth' => 'required|date',
            'date' => 'string',
            'appts.*.status' => 'string',
            'appointment.status' => 'string',
            'appointment.notes' => 'string',
            'appointment.price' => 'string',
        ];
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
     * Save the table
     *
     * @return void
     */
    public function save()
    {
        $apptsToPersist = $this->appointments->whereIn('id', array_keys($this->apptsToUpdate));
        foreach ($apptsToPersist as $appointment) {
            $appointment->update([
                'status' => $this->apptsToUpdate[$appointment->id]
            ]);
        }

        $this->showMessage();
    }

    /**
     * React when appointment status is updated
     *
     * @param array $event
     */
    public function apptUpdated(array $event)
    {
        // Update appointment in array
        $this->appts[$event['target']]['status'] = $event['status'];
        // Add appointment to array that need to be persisted
        $this->apptsToUpdate[$event['target']] = $event['status'];
        // Update count
        $this->makeCounts(collect($this->appts));
    }

    /**
     * Change active month from datepicker
     *
     * @param string $value
     */
    public function updatedActiveMonth(string $value)
    {
        $this->date = Carbon::parse($value)->format('Y-m');
        $this->activeMonth = $this->date;
        $this->appointments = $this->getMonthAppointments();
        $this->makeCounts();
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
                'appointments.status',
                'appointments.notes'
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
    }

    /**
     * Return collection of all appointments of specified month
     *
     * @return Collection
     */
    private function getMonthAppointments(): Collection
    {
        $this->clearArrays();

        $start = Carbon::parse($this->activeMonth)->firstOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::parse($this->activeMonth)->endOfMonth()->format('Y-m-d H:i:s');

        $appointments = Appointment::whereBetween('appointments.time', [$start, $end])
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
                'pets.status AS pet_status',
                'customers.lastname AS customer_lastname',
                DB::raw('DATE_FORMAT(appointments.time, "%d %b %H:%i") as formatted_date')
                )
            ->orderBy('appointments.time')
            ->get();

        foreach ($appointments as $item) {
            $this->appts[$item->id] = $item->toArray();
        }

        return $appointments;
    }

    /**
     * Make counts of all appointments of specified month
     *
     */
    private function makeCounts($source = null)
    {
        if ($source === null) {
            $source = $this->appointments;
        }

        $tvaQuery = $source->whereIn('status', Appointment::$tvaStatus);
        $this->tva = (clone $tvaQuery)->sum('price');
        $this->tvaCount = (clone $tvaQuery)->count();

        $htvaQuery = $source->where('status', 'private');
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

    private function clearArrays()
    {
        $this->appts = [];
        $this->apptsToUpdate = [];
    }
}
