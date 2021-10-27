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

    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'customer.genre' => [
                Rule::in(['unknown','female','male']),
            ],
            'pet.name' => 'required|string|min:2|max:255',
            'pet.customer_id' => 'required|numeric',
            'birthday' => 'nullable|string',
            'pet.status' => 'required|string',
            'pet.main_breed_id' => 'required|numeric',
            'pet.second_breed_id' => 'nullable|numeric',
            'pet.size' => 'required|string',
            'hours' => 'required|string',
            'minutes' => 'required|string',
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
        $this->customers = Customer::orderBy('firstname')->orderBy('lastname')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->firstname . ' ' . $item->lastname,
            ];
        })
        ->toArray();

        $this->status = Pet::getStatus();
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
