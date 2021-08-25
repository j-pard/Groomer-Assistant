<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public Customer $customer;
    public array $orphans = [];
    public ?int $newPetId = null;

    protected $listeners = ['refreshCustomer' => '$refresh'];

    protected function newPetRules()
    {
        return [
            'newPetId' => 'nullable|numeric',
        ];
    }

    protected function customerRules()
    {
        return [
            // Info
            'customer.genre' => [
                Rule::in(['unknown','female','male']),
            ],
            'customer.lastname' => 'required|string|min:2|max:255',
            'customer.firstname' => 'required|string|min:2|max:255',
            'customer.zip_code' => 'nullable|numeric|digits_between:4,6',
            'customer.city' => 'nullable|string|min:2|max:255',
            'customer.address' => 'nullable|string|min:2|max:255',
            // Contact
            'customer.email' => 'nullable|unique:customers,email,' . (empty($this->customer->id) ? 'NULL' : $this->customer->id) . '|email|max:255',
            'customer.phone' => 'required|unique:customers,phone,' . (empty($this->customer->id) ? 'NULL' : $this->customer->id) . '|string|max:255',
            'customer.secondary_phone' => 'nullable|string|max:255',
            // Details
            'customer.more_info' => 'nullable|string|max:65535',
        ];
    }

    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function rules()
    {
        return array_merge($this->newPetRules(), $this->customerRules());
    }

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        if (!$this->customer->exists) {
            $this->customer->genre = 'unknown';
        }
    }

    /**
     * Render the component
     *
     * @return view
     */
    public function render()
    {
        return view('livewire.customers.form');
    }

    public function loadNewPetModal()
    {
        $this->newPetId = null;
        $this->orphans = Pet::getOrphansList();
        $this->dispatchBrowserEvent('form-modal-loaded', ['modalId' => 'addPetModal']);
    }

    /**
     * Save the model
     *
     * @return void
     */
    public function save()
    {
        $this->validate($this->customerRules());

        $this->customer->save();

        if ($this->customer->wasRecentlyCreated) {
            $this->emit('refreshCustomer');
        }
    }

    /**
     * Delete the model
     *
     */
    public function deleteCustomer()
    {
        if ($this->customer->pets()->count() > 0 || $this->customer->appointments()->count() > 0) {
            return redirect()->back()->with('error', 'Suppression impossible, il existe des données pour ce client.');
        }

        $this->customer->delete();

        return redirect()->route('customers.index');
    }

    /**
     * Detach specified pet
     *
     * @param string $id
     */
    public function detachPet(string $id)
    {
        Pet::find($id)->update([
            'customer_id' => null,
        ]);

        $this->customer->load('pets');
    }

    /**
     * Attach specified pet
     *
     */
    public function attachPet()
    {
        $this->validate($this->newPetRules());

        Pet::find($this->newPetId)->update([
            'customer_id' => $this->customer->id,
        ]);

        $this->customer->load('pets');

        $this->dispatchBrowserEvent('form-modal-saved', ['modalId' => 'addPetModal']);
    }
}
