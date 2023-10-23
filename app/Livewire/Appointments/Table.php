<?php

namespace App\Livewire\Appointments;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Dog;
use App\Traits\Livewire\WithModals;
use App\Traits\Livewire\WithToast;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Table extends Component
{
    use WithModals;
    use WithToast;

    public ?Appointment $appointment = null;
    public ?string $search = null;
    public string $date;
    public array $statuses = [];
    public ?Collection $dogs = null;

    // Modal
    public bool $isUpdating = false;
    public bool $isModalXl = false;
    public string $apptDate;
    public string $apptTime;
    public int $activeStep = 1;
    // Dog
    public int $dogId = 0;
    public ?string $dogName = null;
    public ?string $ownerName = null;
    public ?string $dogDetails = null;
    public ?int $selectedDog = null;
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
        if ($name === 'search') {
                // Step 1 > Search dogs
                if (strlen($value) < 2) {
                    // Emptying the list
                    $this->dogs = null;
                } else {
                    // Validate live search
                    $this->validate([
                        $name => 'required|string|min:2',
                    ]);
                    $this->searchDogs();
                }
        } elseif ($name === 'selectedDog') {
            // Step 1 > Select dog
            $this->validate([
                $name => 'required|numeric',
            ]);

            $dog = Dog::findOrFail($this->selectedDog);
            $this->dogId = $dog->id;
            $this->dogName = $dog->name;
            $this->ownerName = $dog->owner->name;
            $this->activeStep = 2;
        } else {
            $this->validate([
                $name => Arr::get($this->rules(), $name, 'required|string'),
            ]);

            try {
                // Update Appointment
                // "if" is used to avoind unwanted update when closing modals.
                if ($this->appointment?->id !== null) {
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
        $this->activeStep = 1;
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
        $this->dogs = null;
        $this->isModalXl = false;
        $this->isUpdating = false;
        $this->ownerName = null;
        $this->search = null;
        $this->selectedDog = null;
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
     * Search dogs by their name or by owner.
     *
     * @return void
     */
    private function searchDogs()
    {
        $this->dogs = Dog::query()
            ->whereIn('status', ['active', 'private'])
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhereHas('owner', function (Builder $ownerQuery) {
                $ownerQuery->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('secondary_phone', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('name', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->take(5)
            ->get();
    }
}
