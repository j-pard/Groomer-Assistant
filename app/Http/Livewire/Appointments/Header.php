<?php

namespace App\Http\Livewire\Appointments;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Header extends Component
{
    public Model $model;

    public string $backUrl;

    /**
     * Mount component
     */
    public function mount(string $backUrl)
    {
        $this->backUrl = $backUrl;
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.appointments.header');
    }

    /**
     * Delete the model
     *
     */
    public function deleteAppointment()
    {
        $customer = $this->model->customer;
        $this->model->delete();

        return redirect()->route('customers.appointments', ['customer' => $customer]);
    }
}
