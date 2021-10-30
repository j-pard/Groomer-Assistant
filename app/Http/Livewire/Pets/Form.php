<?php

namespace App\Http\Livewire\Pets;

use App\Models\Breed;
use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public Pet $pet;
    public array $breeds;
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
            'pet.customer_id' => 'required|numeric',
            'birthdate' => 'nullable|string',
            'pet.status' => 'required|string',
            'pet.main_breed_id' => 'required|numeric',
            'pet.second_breed_id' => 'nullable|numeric',
            'pet.size' => 'required|string',
            'hours' => 'nullable|numeric',
            'minutes' => 'nullable|numeric',
            'pet.remarks' => 'nullable|string|max:65535',
        ];
    }

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        if (!$this->pet->exists) {
            $this->pet->genre = 'unknown';
        }

        $this->breeds = [-1 => '---'] + Breed::all()->sortBy('breed')->pluck('breed', 'id')->toArray();
        $this->customers = Customer::getList();

        $this->status = Pet::getStatus();
        $this->sizes = Pet::getSizeOptions();
        $this->birthdate = $this->pet->birthdate;

        $duration = $this->pet->getDurationInHoursMinutes();
        $this->hours = $duration['hours'];
        $this->minutes = $duration['minutes'];
    }

    /**
     * Render the component
     *
     * @return view
     */
    public function render()
    {
        return view('livewire.pets.form');
    }

    /**
     * Save the model
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $this->pet->save();

        if ($this->pet->wasRecentlyCreated) {
            return redirect()->route('pets.edit', ['pet' => $this->pet]);
        }
    }
}
