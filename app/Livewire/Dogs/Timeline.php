<?php

namespace App\Livewire\Dogs;

use App\Enums\AppointmentStatus;
use App\Models\Dog;
use App\Traits\Livewire\CRUD\ReactiveAppointment;
use App\Traits\Livewire\WithModals;
use App\Traits\Livewire\WithToast;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Livewire\Component;

class Timeline extends Component
{
    use ReactiveAppointment;
    use WithModals;
    use WithToast;

    public Dog $dog;
    public string $date;
    public array $statuses = [];

    /**
     * Call on component mount.
     *
     * @param Dog $dog
     * @return void
     */
    public function mount(Dog $dog)
    {
        $this->dog = $dog;
        $this->date = Carbon::now()->format('Y-m-d');
        $this->statuses = AppointmentStatus::getAsOptions();
        $this->resetAppointment();
    }

    /**
     * Render the table.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.dogs.timeline', [
            'items' => $this->getDogsTimelineQuery(),
        ]);
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
     * Generate dogs query with search parameters.
     *
     * @return Collection
     */
    private function getDogsTimelineQuery(): Collection
    {
        return $this->dog->appointments()
            ->orderBy('time', 'DESC')
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
        $params['search'] = false;
        $params['pagination'] = false;

        return view('livewire.placeholders.table-skeleton', $params);
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
        // Live update
        $this->validate([
            $name => Arr::get($this->rules(), $name, 'required|string'),
        ]);

        $this->liveUpdateAppointment($name, $value);
    }
}
