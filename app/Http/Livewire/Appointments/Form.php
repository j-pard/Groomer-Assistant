<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Customer;
use Carbon\Carbon;
use Livewire\Component;

class Form extends Component
{
    public Appointment $appointment;
    public ?Customer $customer;

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
            'appointment.notes' => 'string',
            'appointment.status' => 'string',
        ];
    }

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->pets = $this->customer->getPetsAsOptions();
        $this->status = Appointment::getStatusAsOptions();
        $this->appointment->pet_id = $this->appointment->pet_id ?? array_key_first($this->pets);
        $this->appointment->status = $this->appointment->status ?? 'planned';

        if ($this->appointment->exists) {
            $time = Carbon::parse($this->appointment->time);
            $this->date = $time->format('d-m-Y');
            $this->time = $time->format('H:i');
        } else {
            $this->date = Carbon::now()->format('d-m-Y');
            $this->time = '08:30';
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

        return redirect()->route('customers.appointments', ['customer' => $this->customer]);
    }
}
