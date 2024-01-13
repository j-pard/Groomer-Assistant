<?php

namespace App\Livewire\Dogs;

use App\Enums\DogSizes;
use App\Enums\DogStatus;
use App\Models\Breed;
use App\Models\Dog;
use App\Models\Owner;
use App\Traits\Livewire\WithToast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Creator extends Component
{
    use WithToast;

    public string $activeStep;
    public array $breeds = [];
    public ?Collection $existingDogs = null;
    public ?Collection $existingOwners = null;

    // Dog
    public string $name;
    public string $genre;
    public int $main_breed_id;
    public ?int $second_breed_id = null;
    public ?int $dogId = null;

    // Owner
    public ?string $owner_id = null;
    public string $owner_name;
    public string $owner_phone;

    /**
     * Call on component mount.
     *
     * @return void
     */
    public function mount()
    {
        $this->breeds = Breed::getAsOptions();
        $this->genre = 'unknown';
        $this->activeStep = 'dog';
    }

    /**
     * Define rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // Dog
            'name' => 'required|string|min:2|max:100',
            'genre' => 'required|string|in:unknown,female,male',
            'main_breed_id' => 'required|integer',
            'second_breed_id' => 'nullable|integer',

            // Owner
            'owner_id' => 'nullable|integer',
            'owner_name' => 'required|string|min:2|max:100',
            'owner_phone' => 'required|string|min:2|max:50',
        ];
    }

    /**
     * Render the table.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.dogs.create');
    }

    /**
     * Save the new dog and related owner.
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            // Create new owner if no one selected.
            if ($this->owner_id === null) {
                // Create new owner
                $owner = Owner::create([
                    'name' => $this->owner_name,
                    'phone' => $this->owner_phone,
                ]);

                $this->owner_id = $owner->id;
            }

            // Create new dog.
            $dog = Dog::create([
                'genre' => $this->genre,
                'main_breed_id' => $this->main_breed_id,
                'name' => $this->name,
                'owner_id' => $this->owner_id,
                'second_breed_id' => $this->second_breed_id,
                'size' => DogSizes::MEDIUM,
                'status' => DogStatus::ACTIVE,
            ]);

            $this->dogId = $dog->id;
        });

        $this->showSuccessMessage();

        $this->redirect(route('dogs.show', ['dog' => $this->dogId]));
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
        // Update name in step 1 "dog"
        if ($name === 'name') {
            if (strlen($value) < 2) {
                // Emptying the list
                $this->existingDogs = null;
            } else {
                // Validate live search
                $this->validate([
                    $name => Arr::get($this->rules(), $name, 'required|string'),
                ]);

                // Live query for existing dogs with same name.
                $this->existingDogs = Dog::where('name', 'LIKE', '%' . $value . '%')
                    ->orderBy('name')
                    ->take(5)
                    ->get();
            }
        }

        // Update owner_name in step 2 "owner"
        if ($name === 'owner_name') {
            if (strlen($value) < 2) {
                // Emptying the list
                $this->existingOwners = null;
            } else {
                // Validate live search
                $this->validate([
                    $name => Arr::get($this->rules(), $name, 'required|string'),
                ]);

                // Live query for existing owners with same name or phone number.
                $this->existingOwners = Owner::where(function (Builder $query) use ($value) {
                    $query->where('name', 'LIKE', '%' . $value . '%')
                        ->orWhere('phone', 'LIKE', '%' . $value . '%');
                })
                    ->orderBy('name')
                    ->take(5)
                    ->get();
            }
        }
    }

    /**
     * Change step to the specified one.
     * Validate corresponding data and display correct step.
     *
     * @param string $step
     * @return void
     */
    public function nextStep(string $step)
    {
        // STEP 2 - From dog step to owner step
        if ($step === 'owner') {
            // Validate new dog name.
            $this->validate([
                'name' => Arr::get($this->rules(), 'name'),
            ]);

            // Move forward one step
            $this->activeStep = 'owner';
        }

        // STEP 3 - From owner step to creation step.
        if ($step === 'creation') {
            if ($this->owner_id !== null) {
                // Take existant owner.
                $owner = Owner::findOrFail($this->owner_id);
                $this->owner_name = $owner->name;
                $this->owner_phone = $owner->phone;
            } else {
                // Validate new owner name.
                $this->validate([
                    'owner_name' => Arr::get($this->rules(), 'owner_name'),
                ]);
            }

            // Move forward one step
            $this->activeStep = 'creation';
        }
    }

    /**
     * Set owner_id null and unchecked.
     */
    public function resetOwnerId()
    {
        $this->owner_id = null;
    }
}
