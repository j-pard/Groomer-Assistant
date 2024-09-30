<?php

namespace App\Livewire\Appointments;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Dog;
use App\Traits\Livewire\CRUD\ReactiveAppointment;
use App\Traits\Livewire\WithModals;
use App\Traits\Livewire\WithToast;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class Table extends Component
{
    use ReactiveAppointment;
    use WithModals;
    use WithToast;

    public ?string $search = null;
    public string $date;
    public array $statuses = [];
    public ?Collection $dogs = null;

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
        return ReactiveAppointment::getValidationRules();
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
     * @param string|integer|boolean|null $value
     * @return void
     */
    public function updated(string $name, string|int|bool|null $value)
    {
        if ($name === 'search') {
            // Step 1 > Search dogs
            if (strlen($value) < 2) {
                // Emptying the list
                $this->dogs = null;
            } else {
                // Validate live search
                $this->search = Str::of($this->search)->trim()->value();
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
            // Live update
            $this->validate([
                $name => Arr::get($this->rules(), $name, 'required|string'),
            ]);

            $this->liveUpdateAppointment($name, $value);
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
