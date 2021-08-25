<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public Customer $customer;

    protected $listeners = ['refreshCustomer' => '$refresh'];

    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function rules()
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

    /**
     * Save the model
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $this->customer->save();

        if ($this->customer->wasRecentlyCreated) {
            $this->emit('refreshCustomer');
        }
    }

    public function deleteCustomer()
    {
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
}
