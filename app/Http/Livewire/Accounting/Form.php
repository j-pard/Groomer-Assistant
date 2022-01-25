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
     * Save the model
     *
     * @return void
     */
    public function save()
    {
        $this->showMessage();
    }

    public function previousMonth()
    {
        $this->date = Carbon::parse($this->activeMonth)->subMonth()->format('Y-m');
        $this->activeMonth = $this->date;
        $this->appointments = $this->getMonthAppointments();
        $this->makeCounts();
    }

    public function nextMonth()
    {
        $this->date = Carbon::parse($this->activeMonth)->addMonth()->format('Y-m');
        $this->activeMonth = $this->date;
        $this->appointments = $this->getMonthAppointments();
        $this->makeCounts();
    }

    private function getMonthAppointments()
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
