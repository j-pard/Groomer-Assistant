<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class Form extends Component
{
    public Customer $customer;

    protected $rules = [
        // Info
        'customer.lastname' => 'required|string|min:2|max:255',
        'customer.firstname' => 'required|string|min:2|max:255',
        'customer.zip_code' => 'nullable|numeric|digits_between:4,6',
        'customer.city' => 'nullable|string|min:2|max:255',
        'customer.address' => 'nullable|string|min:2|max:255',
        // Contact
        'customer.email' => 'nullable|email|max:255',
        'customer.phone' => 'nullable|string|max:255',
        'customer.secondary_phone' => 'nullable|string|max:255',
        // Details
        'customer.more_info' => 'nullable|string|max:65535',
    ];

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.customers.form');
    }

    public function save()
    {
        $this->validate();

        $this->customer->save();
    }
}
