<?php

namespace App\Livewire\Accounting;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Customer;
use App\Traits\Livewire\WithModals;
use App\Traits\Livewire\WithToast;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Form extends Component
{
    use WithModals;
    use WithToast;

    public string $date;
    public string $activeMonth;
    public Collection $appointments;
    public array $appts;
    public array $apptsToUpdate = [];
    public array $statuses;
    public array $offStatus;

    // Header values
    public string $tva;
    public string $bank;
    public string $htva;
    public string $cumulated;
    public string $tvaCount;
    public string $bankCount;
    public string $htvaCount;
    public string $cumulatedCount;
    public string $remaining;
    public string $totalOfYearCount;

    // Modal
    public ?Appointment $appointment;
    public string $dogName;
    public string $ownerName;
    public string $apptDate;
    public string $apptTime;
    public string $apptNotes;
    public string $apptStatus;
    public string $apptPrice;

    protected $listeners = ['apptUpdated'];

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m');
        $this->activeMonth = $this->date;
        $this->appointments = $this->getMonthAppointments();
        $this->statuses = AppointmentStatus::getAsOptions();
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

        $this->appointments = $this->getMonthAppointments();

        $this->showSuccessMessage();
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
     * @return void
     */
    public function loadAppointment(string $id): void
    {
        $this->appointment = Appointment::where('appointments.id', $id)
            ->join('dogs', 'appointments.dog_id', '=', 'dogs.id')
            ->join('customers', 'appointments.customer_id', '=', 'customers.id')
            ->select(
                'appointments.id',
                'appointments.time',
                'appointments.price',
                'appointments.dog_id',
                'appointments.customer_id',
                'appointments.status',
                'appointments.notes'
            )
            ->first();

        $time = Carbon::parse($this->appointment->time);
        $this->apptDate = $time->format('Y-m-d');
        $this->apptTime = $time->format('H:i');
        $this->ownerName = Customer::find($this->appointment->customer_id)->getFullName(true);
        $this->dogName = $this->appointment->dog->name;

        $this->showModal('apptModal');
    }

    /**
     * Reset modal variables
     *
     * @return void
     */
    public function resetAppointment(): void
    {
        $this->appointment = new Appointment();
        $this->dogName = '';
        $this->ownerName = '';
        $this->apptDate = '';
        $this->apptTime = '';
        $this->apptNotes = '';
        $this->apptStatus = '';
        $this->apptPrice = '';
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
            ->join('dogs', 'appointments.dog_id', '=', 'dogs.id')
            ->join('customers', 'appointments.customer_id', '=', 'customers.id')
            ->select(
                'appointments.id',
                'appointments.time',
                'appointments.price',
                'appointments.dog_id',
                'appointments.customer_id',
                'appointments.status',
                'dogs.name AS dog_name',
                'dogs.status AS dog_status',
                'customers.lastname AS customer_lastname',
                DB::raw('DATE_FORMAT(appointments.time, "%H:%i") as formatted_date')
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
     * @param Collection|null $source
     * @return void
     */
    private function makeCounts(?Collection $source = null): void
    {
        if ($source === null) {
            $source = $this->appointments;
        }

        $tvaQuery = $source->whereIn('status', AppointmentStatus::tvaStatuses());
        $this->tva = (clone $tvaQuery)->sum('price');
        $this->tvaCount = (clone $tvaQuery)->count();

        $bankQuery = $source->whereIn('status', AppointmentStatus::tvaBankStatuses());
        $this->bank = (clone $bankQuery)->sum('price');
        $this->bankCount = (clone $bankQuery)->count();

        $htvaQuery = $source->whereIn('status', AppointmentStatus::privateStatuses());
        $this->htva = (clone $htvaQuery)->sum('price');
        $this->htvaCount = (clone $htvaQuery)->count();

        $this->cumulated = $this->tva + $this->htva;
        $this->cumulatedCount = $this->tvaCount + $this->htvaCount;

        $totalOfYearQuery = Appointment::whereBetween('time', [
            Carbon::parse($this->activeMonth)->firstOfYear()->format('Y-m-d H:i:s'),
            Carbon::parse($this->activeMonth)->lastOfYear()->format('Y-m-d H:i:s')
        ]);
        $this->remaining = 25000 - (clone $totalOfYearQuery)->whereIn('status', AppointmentStatus::tvaStatuses())->sum('price');
        $this->totalOfYearCount = (clone $totalOfYearQuery)->whereNotIn('status', ['cancelled'])->count();
    }

    /**
     * Clear arrays of appointments
     *
     * @return void
     */
    private function clearArrays(): void
    {
        $this->appts = [];
        $this->apptsToUpdate = [];
    }

    /**
     * Display skeleton during component loading.
     *
     * @param array $params
     * @return View
     */
    public function placeholder(array $params = []): View
    {
        $params['rows'] = 20;
        $params['search'] = false;
        $params['pagination'] = false;

        return view('livewire.placeholders.table-skeleton', $params);
    }
}
