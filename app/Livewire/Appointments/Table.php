<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Table extends Component
{
    public string $date;

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m-d');
    }

    /**
     * Define rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'date' => 'required|string',
        ];
    }

    /**
     * Render the table.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.appts.table', [
            'appointments' => $this->getAppointmentsQuery(),
        ]);
    }

    /**
     * Generate appointments query with search parameters.
     *
     * @return Collection
     */
    private function getAppointmentsQuery(): Collection
    {
        return Appointment::query()
            ->with('dog')
            ->whereBetween('time', [
                Carbon::parse($this->date)->startOfDay(),
                Carbon::parse($this->date)->endOfDay()
            ])
            ->orderBy('time')
            ->get();
    }

    /**
     * Display skeleton during component loading.
     *
     * @param array $params
     * @return View
     */
    public function placeholder(array $params = []): View
    {
        $params['rows'] = 10;
        $params['search'] = true;
        $params['pagination'] = false;

        return view('livewire.placeholders.table-skeleton', $params);
    }
}
