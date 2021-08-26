<?php

namespace App\Http\Livewire\Customers;

use App\Models\Appointment;
use App\Models\Customer;
use Carbon\Carbon;
use Livewire\Component;

class Header extends Component
{
    public Customer $customer;

    public string $backUrl;
    public string $title;
    public array $navigation;
    public array $menu;

    public ?Appointment $appointment;
    public string $date;
    public string $time;
    public array $pets;
    public ?string $petId;

    /**
     * Mount component
     */
    public function mount(string $backUrl)
    {
        $this->backUrl = $backUrl;
        $this->title = $this->customer->exists ? $this->customer->firstname . ' ' . $this->customer->lastname : '';
        $this->navigation = $this->getNavigation();
        $this->menu = $this->getMenuActions();
        $this->appointment = null;
        $this->date = '';
        $this->time = '';
        $this->pets = [];
        $this->petId = null;
    }

    public function rules()
    {
        return [
            'date' => 'string',
            'time' => 'string',
            'appointment.notes' => 'string',
        ];
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.customers.header');
    }

    public function loadAppointmentModal()
    {
        $now = Carbon::now();
        $this->date = $now->format('d-m-Y');
        $this->time = $now->format('H:i');
        $this->pets = $this->customer->getPetsAsOptions();
        $this->petId = array_key_first($this->pets);

        $this->appointment = new Appointment;

        $this->dispatchBrowserEvent('form-modal-loaded', ['modalId' => 'apptModal']);
    }

    public function saveAppointment()
    {
        $this->validate();

        $this->appointment->time = Carbon::parse($this->date . ' ' . $this->time)->format('Y-m-d H:i:s');
        $this->appointment->status = 'planned';
        $this->appointment->customer_id = $this->customer->id;
        $this->appointment->pet_id = $this->petId;

        $this->appointment->save();

        // Todo
        return redirect()->route('customers.appointments', ['customer' => $this->customer]);
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

    /**
     * Return array of menu actions
     *
     * @return array
     */
    private function getMenuActions() :array
    {
        return [];
    }
}
