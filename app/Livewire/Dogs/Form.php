<?php

namespace App\Livewire\Dogs;

use App\Enums\DogSizes;
use App\Enums\DogStatus;
use App\Models\Breed;
use App\Models\Dog;
use App\Models\Owner;
use App\Traits\Livewire\WithModals;
use App\Traits\Livewire\WithToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Form extends Component
{
    use WithModals;
    use WithPagination;
    use WithToast;

    // General
    public Dog $dog;
    public Owner $owner;
    public array $breeds = [];
    public array $statuses = [];
    public array $sizes = [];

    // Dog
    public string $name;
    public string $genre;
    public ?string $birthdate;
    public string $status;
    public string $size;
    public ?string $details;
    public bool $has_warning = false;
    public ?int $main_breed_id = null;
    public ?int $second_breed_id = null;

    // Duration
    public int $hours = 0;
    public int $minutes = 0;

    // Owner
    public string $owner_name;
    public string $owner_phone;
    public ?string $owner_address;
    public ?string $owner_city;
    public ?string $owner_email;
    public bool $owner_has_reminder = false;
    public ?string $owner_secondary_phone;
    public ?int $owner_zip_code;

    // Delete dog
    public bool $ownerHasMoreDogs = false;
    public bool $isDeletingOwner = false;

    /**
     * Call on component mount.
     *
     * @param Dog $dog
     * @return void
     */
    public function mount(Dog $dog)
    {
        // General
        $this->dog = $dog;
        $this->owner = $dog->owner;
        $this->breeds = Breed::getAsOptions();
        $this->statuses = DogStatus::getAsOptions();
        $this->sizes = DogSizes::getAsOptions();

        // Dog
        $this->name = $this->dog->name;
        $this->genre = $this->dog->genre;
        $this->birthdate = $this->dog->birthdate;
        $this->size = $this->dog->size;
        $this->status = $this->dog->status;
        $this->details = $this->dog->details;
        $this->has_warning = $this->dog->has_warning;
        $this->main_breed_id = $this->dog->main_breed_id;
        $this->second_breed_id = $this->dog->second_breed_id;
        $this->formatDuration();

        // Owner
        $this->owner_name = $this->owner->name;
        $this->owner_phone = $this->owner->phone;
        $this->owner_address = $this->owner->address;
        $this->owner_city = $this->owner->city;
        $this->owner_email = $this->owner->email;
        $this->owner_has_reminder = $this->owner->has_reminder;
        $this->owner_secondary_phone = $this->owner->secondary_phone;
        $this->owner_zip_code = $this->owner->zip_code;
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
            'birthdate' => 'nullable|string',
            'details' => 'nullable|string',
            'genre' => 'required|string|in:unknown,female,male',
            'has_warning' => 'boolean',
            'main_breed_id' => 'required|integer',
            'name' => 'required|string|min:2|max:100',
            'second_breed_id' => 'nullable|integer',
            'size' => 'required|string|in:' . DogSizes::getValidationInRuleValues(),
            'status' => 'required|string|in:' . DogStatus::getValidationInRuleValues(),

            // Duration
            'hours' => 'nullable|integer',
            'minutes' => 'nullable|integer',

            // Owner
            'owner_address' =>  'nullable|string|max:255',
            'owner_city' =>  'nullable|string|min:2|max:100',
            'owner_email' => 'nullable|email|max:100',
            'owner_has_reminder' => 'boolean',
            'owner_name' => 'required|string|min:2|max:100',
            'owner_phone' => 'required|string|min:2|max:50',
            'owner_secondary_phone' => 'nullable|string|max:100',
            'owner_zip_code' => 'nullable|integer|digits_between:4,6',
        ];
    }

    /**
     * Render the table.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.dogs.form');
    }

    public function save()
    {
        $this->validate();

        $this->dog->update([
            'average_duration' => intval($this->hours * 60) + intval($this->minutes),
            'birthdate' => $this->birthdate,
            'details' => $this->details,
            'genre' => $this->genre,
            'has_warning' => $this->has_warning,
            'main_breed_id' => $this->main_breed_id,
            'name' => $this->name,
            'second_breed_id' => $this->second_breed_id,
            'size' => $this->size,
            'status' => $this->status,
        ]);

        $this->owner->update([
            'address' => $this->owner_address,
            'city' => $this->owner_city,
            'email' => $this->owner_email,
            'has_reminder' => $this->owner_has_reminder,
            'name' => $this->owner_name,
            'phone' => $this->owner_phone,
            'secondary_phone' => $this->owner_secondary_phone,
            'zip_code' => $this->owner_zip_code,
        ]);

        $this->showSuccessMessage();
    }

    /**
     * React on updated hook from attribute.
     * Update model after validating attribute value.
     *
     * @param string $name
     * @param string|integer|boolean $value
     * @return void
     */
    public function updated(string $name, string|int|bool|null $value)
    {
        $this->validate([
            $name => Arr::get($this->rules(), $name, 'required|string'),
        ]);

        try {
            if (Str::startsWith($name, 'owner_')) {
                $cleanedName = str_replace('owner_', '', $name);
                // Update Owner
                $this->owner->update([
                    $cleanedName => $value,
                ]);
            } else {
                // Update Dog
                switch ($name) {
                    case 'hours':
                    case 'minutes':
                        // Update duration
                        $this->dog->update([
                            // *?? 0* is used to set to 0 if input is empty
                            'average_duration' => intval(($this?->hours ?? 0) * 60) + intval($this?->minutes ?? 0),
                        ]);

                        $this->formatDuration();
                        break;

                    default:
                        $this->dog->update([
                            $name => $value,
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
     * Check if owner has other dogs and open delete dog modal.
     *
     * @return void
     */
    public function openDeleteModal()
    {
        $this->ownerHasMoreDogs = $this->owner->dogs()->where('dogs.id', '!==', $this->dog->id)->count() > 0;
        $this->isDeletingOwner = !$this->ownerHasMoreDogs;
        $this->showModal('deleteDogModal');
    }

    /**
     * Get dog duration and format it to hours and minutes.
     *
     * @return void
     */
    private function formatDuration()
    {
        $duration = $this->dog->getDurationInHoursMinutes();
        $this->hours = $duration['hours'];
        $this->minutes = $duration['minutes'];
    }
}
