<?php

namespace App\Http\Livewire\Appointments;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Pet;
use Carbon\Carbon;

class Form extends LivewireForm
{
    public Appointment $appointment;
    public ?Customer $customer;
    public ?Pet $pet;

    public array $customers;
    public array $pets;
    public string $date;
    public string $time;
    public array $status;

    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'appointment.pet_id' => 'required|numeric',
            'appointment.time' => 'string',
            'appointment.price' => 'nullable|numeric|min:0',
            'time' => 'string',
            'appointment.notes' => 'string|nullable',
            'appointment.status' => 'string',
        ];
    }

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->customers = Customer::getList();
        $this->pets = $this->customer->getPetsAsOptions();
        $this->status = Appointment::getStatusAsOptions();

        if ($this->pet->exists) {
            $this->appointment->pet_id = $this->pet->id;
        } else {
            $this->appointment->pet_id = $this->appointment->pet_id ?? array_key_first($this->pets);
        }
        
        if ($this->appointment->exists) {
            $time = Carbon::parse($this->appointment->time);
            $this->date = $time->format('Y-m-d');
            $this->time = $time->format('H:i');
        } else {
            $this->date = Carbon::now()->format('Y-m-d');
            $this->time = '08:30';
            $this->appointment->status = 'planned';
        }
    }

    /**
     * Render the component
     *
     * @return view
     */
    public function render()
    {
        return view('livewire.appointments.form');
    }

    /**
     * Save the model
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $this->appointment->time = Carbon::parse($this->date . ' ' . $this->time)->format('Y-m-d H:i:s');
        $this->appointment->customer_id = $this->customer->id;

        $this->appointment->save();

        $this->showMessage();
    }
}
