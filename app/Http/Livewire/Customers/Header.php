<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class Header extends Component
{
    public Customer $customer;

    public string $backUrl;
    public string $title;
    public array $navigation;
    public array $menu;

    /**
     * Mount component
     */
    public function mount(string $backUrl)
    {
        $this->backUrl = $backUrl;
        $this->title = $this->customer->exists ? $this->customer->getFullName() : '';
        $this->navigation = $this->getNavigation();
    }

    public function rules()
    {
        return [
            'date' => 'string',
            'time' => 'string',
            'appointment.notes' => 'string|nullable',
        ];
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.customers.header');
    }

    /**
     * Delete the model
     *
     */
    public function deleteCustomer()
    {
        $this->customer->delete();

        return redirect()->route('customers.index');
    }
    
    /**
     * Return array of navigation links
     *
     * @return array
     */
    private function getNavigation() :array
    {
        $nav = [];

        if ($this->customer->exists) {
            $nav = [
                'Détails' => route('customers.edit', ['customer' => $this->customer]),
                'Rendez-vous'=> route('customers.appointments', ['customer' => $this->customer]),
            ];
        }

        return $nav;
    }
}
