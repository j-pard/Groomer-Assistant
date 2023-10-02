<?php

namespace App\Livewire\Dogs;

use App\Enums\DogSizes;
use App\Enums\DogStatus;
use App\Models\Breed;
use App\Models\Dog;
use App\Traits\Livewire\WithToast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Form extends Component
{
    use WithPagination;
    use WithToast;

    // General
    public Dog $dog;
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

        // Duration
        $duration = $this->dog->getDurationInHoursMinutes();
        $this->hours = $duration['hours'];
        $this->minutes = $duration['minutes'];

        // Owner
        $this->owner_name = $this->dog->owner_name;
        $this->owner_phone = $this->dog->owner_phone;
        $this->owner_address = $this->dog->owner_address;
        $this->owner_city = $this->dog->owner_city;
        $this->owner_email = $this->dog->owner_email;
        $this->owner_has_reminder = $this->dog->owner_has_reminder;
        $this->owner_secondary_phone = $this->dog->owner_secondary_phone;
        $this->owner_zip_code = $this->dog->owner_zip_code;
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
            'birthdate' => 'nullable|string',
            'status' => 'required|string|in:' . DogStatus::getValidationInRuleValues(),
            'size' => 'required|string|in:' . DogSizes::getValidationInRuleValues(),
            'details' => 'nullable|string',
            'main_breed_id' => 'required|integer',
            'second_breed_id' => 'nullable|integer',

            // Duration
            'hours' => 'nullable|integer',
            'minutes' => 'nullable|integer',

            // Owner
            'owner_name' => 'required|string|min:2|max:100',
            'owner_phone' => 'required|string|min:2|max:50',
            'owner_address' =>  'nullable|string|max:255',
            'owner_city' =>  'nullable|string|min:2|max:100',
            'owner_email' => 'nullable|email|max:100',
            'owner_has_reminder' => 'boolean',
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
            'owner_address' => $this->owner_address,
            'owner_city' => $this->owner_city,
            'owner_email' => $this->owner_email,
            'owner_has_reminder' => $this->owner_has_reminder,
            'owner_name' => $this->owner_name,
            'owner_phone' => $this->owner_phone,
            'owner_secondary_phone' => $this->owner_secondary_phone,
            'owner_zip_code' => $this->owner_zip_code,
            'second_breed_id' => $this->second_breed_id,
            'size' => $this->size,
            'status' => $this->status,
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
    public function updated(string $name, string|int|bool $value)
    {
        $this->validate([
            $name => Arr::get($this->rules(), $name, 'required|string'),
        ]);
        
        try {
            $this->dog->update([
                $name => $value,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);

            $this->showErrorMessage();
        }
    }
}
