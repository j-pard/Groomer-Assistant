<?php

namespace App\Http\Livewire\Pets;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Breed;
use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends LivewireForm
{
    public Pet $pet;
    public array $breeds = [];
    public array $customers;
    public $status;
    public ?string $birthdate;
    public int $hours = 0;
    public int $minutes = 0;
    public array $sizes;

    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'pet.genre' => [
                Rule::in(['unknown','female','male']),
            ],
            'pet.name' => 'required|string|min:2|max:255',
            'pet.customer_id' => 'nullable|numeric',
            'pet.birthdate' => 'nullable|string',
            'pet.status' => 'required|string',
            'pet.main_breed_id' => 'required|numeric',
            'pet.second_breed_id' => 'nullable|numeric',
            'pet.size' => 'required|string',
            'hours' => 'nullable|numeric',
            'minutes' => 'nullable|numeric',
            'pet.remarks' => 'nullable|string|max:65535',
            'pet.has_warning' => 'boolean',
            'pet.warnings' => 'nullable|string|max:65535',
        ];
    }

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->customers = Customer::getList();
        $this->status = Pet::getStatus();
        $this->sizes = Pet::getSizeOptions();

        $duration = $this->pet->getDurationInHoursMinutes();
        $this->hours = $duration['hours'];
        $this->minutes = $duration['minutes'];

        if (!$this->pet->exists) {
            $this->breeds = Breed::getList();
            $this->pet->genre = 'unknown';
            $this->pet->status = 'active';
            $this->pet->size = 'medium';
            $this->pet->main_breed_id = array_search('Inconnu', $this->breeds);
            $this->pet->has_warning = false;
        }
    }

    /**
     * Render the component
     *
     */
    public function render()
    {
        return view('livewire.pets.form');
    }

    /**
     * Save the model
     */
    public function save()
    {
        $this->pet->average_duration = ($this->hours * 60) + $this->minutes;

        $this->validate();

        $this->pet->save();

        if ($this->pet->wasRecentlyCreated) {
            return redirect()->route('pets.edit', ['pet' => $this->pet]);
        }

        $this->showMessage();
    }
}
