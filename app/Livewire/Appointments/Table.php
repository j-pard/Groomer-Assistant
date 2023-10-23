<?php

namespace App\Livewire\Appointments;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Dog;
use App\Traits\Livewire\WithModals;
use App\Traits\Livewire\WithToast;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Table extends Component
{
    use WithModals;
    use WithToast;

    public ?Appointment $appointment = null;
    public string $date;
    public array $statuses = [];
    public array $dogs = [];

    // Modal
    public bool $isUpdating = false;
    public bool $isModalXl = false;
    public string $apptDate;
    public string $apptTime;
    // Dog
    public int $dogId = 0;
    public ?string $dogName = null;
    public ?string $dogDetails = null;
    // Appointment
    public int $apptId = 0;
    public ?string $apptNotes = null;
    public ?string $apptStatus = null;
    public ?string $apptPrice = null;

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        $this->statuses = AppointmentStatus::getAsOptions();
        $this->resetAppointment();
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

            // Dog
            'apptStatus' => 'required|string|in:' . AppointmentStatus::getValidationInRuleValues(),
            'apptTime' => 'required|string',
            'apptPrice' => 'nullable|numeric|min:0',
            'apptNotes' => 'nullable|string',
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
     * React on updated hook from attribute.
     * Update model after validating attribute value.
     *
     * @param string $name
     * @param string|integer|boolean $value
     * @return void
     */
    public function updated(string $name, string|int|bool $value)
    {
        $this->validate([
            $name => Arr::get($this->rules(), $name, 'required|string'),
        ]);

        try {
            // "if" is used to avoind unwanted update when closing modals.
            if ($this->appointment?->id !== null) {
                // Update Appointment
                switch ($name) {
                    case 'apptDate':
                    case 'apptTime':
                        $this->appointment->update([
                            'time' => Carbon::parse($this->apptDate . ' ' . $this->apptTime)->format('Y-m-d H:i:s'),
                        ]);
                        break;
    
                    case 'apptStatus':
                        $this->appointment->update([
                            'status' => $value,
                        ]);
                        break;
    
                    case 'apptPrice':
                        $this->appointment->update([
                            'price' => $value,
                        ]);
                        break;
    
                    case 'apptNotes':
                        $this->appointment->update([
                            'notes' => $value,
                        ]);
                        break;
    
                }
            }
        } catch (\Throwable $th) {
            Log::error($th);
            $this->showErrorMessage();
        }
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
     * Load modal to display existing appointment details.
     *
     * @param integer $id
     * @return void
     */
    public function loadApptModal(int $id)
    {
        $this->resetAppointment();
        $this->appointment = Appointment::with('dog')->findOrFail($id);

        $this->isUpdating = true;
        $this->isModalXl = $this->appointment->dog->has_warning;

        $this->apptDate = Carbon::parse($this->appointment->time)->format('Y-m-d');
        $this->apptTime = Carbon::parse($this->appointment->time)->format('H:i');
        $this->dogId = $this->appointment->dog->id;
        $this->dogName = $this->appointment->dog->name;
        $this->dogDetails = $this->appointment->dog->details;
        $this->apptId = $this->appointment->id;
        $this->apptNotes = $this->appointment->notes;
        $this->apptStatus = $this->appointment->status;
        $this->apptPrice = $this->appointment->price;

        $this->showModal('apptModal');
    }

    /**
     * Prepare data and load modal for appointment creation.
     *
     * @return void
     */
    public function loadCreateApptModal()
    {
        $this->resetAppointment();
        $this->dogs = $this->getDogsAsOptions();
        $this->dogId = $this->dogs[0]['value'];
        $this->apptStatus = $this->statuses[0]['value'];
        $this->showModal('createApptModal');
    }

    /**
     * Create new appointment.
     *
     * @return void
     */
    public function saveAppointment()
    {
        $dog = Dog::findOrFail($this->dogId);

        Appointment::create([
            'dog_id' => $dog->id,
            'time' => Carbon::parse($this->apptDate . ' ' . $this->apptTime)->format('Y-m-d H:i:s'),
            'price' => $this->apptPrice,
            'notes' => $this->apptNotes,
            'status' => $this->apptStatus,
        ]);

        $this->showSuccessMessage();
        $this->hideModal('createApptModal');
    }

    /**
     * Reset values for appointement.
     *
     * @return void
     */
    public function resetAppointment()
    {
        $this->appointment = null;
        $this->apptDate = $this->date;
        $this->apptId = 0;
        $this->apptNotes = null;
        $this->apptPrice = null;
        $this->apptStatus = null;
        $this->apptTime = Appointment::DEFAULT_TIME;
        $this->dogDetails = null;
        $this->dogId = 0;
        $this->dogName = null;
        $this->isModalXl = false;
        $this->isUpdating = false;
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

    /**
     * Get all dogs as options.
     *
     * @return array
     */
    private function getDogsAsOptions(): array
    {
        return Dog::select(
                'dogs.id',
                'dogs.owner_id',
                'dogs.name',
                'owners.name AS owner_name',
                'owners.phone AS owner_phone',
            )
            ->leftJoin('owners', 'owners.id', '=', 'dogs.owner_id')
            ->orderBy('dogs.name')
            ->get()
            ->map(function (Dog $dog) {
                return [
                    'value' => $dog->id, 
                    'label' => $dog->name . ' - ' . $dog->owner_name . ' - ' . $dog->owner_phone,
                ];
            })
            ->toArray();
    }
}
