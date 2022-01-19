<?php

namespace App\Http\Livewire\Appointments;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Index extends LivewireForm
{
    public Collection $appointments;
    public ?Appointment $appointment = null;
    public array $customers = [];
    public ?string $customer = null;
    public array $pets = [];
    public ?string $petId = null;
    public ?Pet $pet;
    public array $status = [];

    public string $date;
    public string $time;
    public string $activeDate;
    public string $modalTitle;
    public bool $isUpdating = false;


    protected function appointmentRules()
    {
        return [
            'appointment.customer_id' => 'required|string',
            'appointment.pet_id' => 'required|string',
            'appointment.time' => 'required|string',
            'appointment.price' => 'nullable|numeric|min:0',
            'appointment.notes' => 'nullable|string',
            'appointment.status' => 'required|string',

            'customer' => 'nullable|numeric',
            'petId' => 'nullable|numeric',
            'date' => 'string',
            'time' => 'string',
        ];
    }

    protected function globalRules()
    {
        return [
            'activeDate' => 'string',
        ];
    }

    /**
     * Valdiation rules
     *
     * @return array
     */
    protected function rules()
    {
        return array_merge($this->appointmentRules(), $this->globalRules());
    }

    /**
     * Mount the component
     *
     */
    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        $this->time = '08:30';
        $this->modalTitle = '';
        $this->activeDate = $this->date;

        $this->loadAppointments();
        $this->customers = Customer::getList();
        $this->status = Appointment::getStatusAsOptions();
    }

    /**
     * Render the component
     *
     * @return view
     */
    public function render()
    {
        return view('livewire.appointments.index');
    }

    public function loadApptModal($id)
    {
        $this->appointment = Appointment::find($id);
        $this->customer = $this->appointment->customer_id;
        $this->pets = $this->appointment->customer->getPetsAsOptions();
        $this->petId = $this->appointment->pet_id;
        $this->pet = Pet::find($this->petId);
        $this->modalTitle = 'Modifier un rendez-vous';
        $this->time = Carbon::parse($this->appointment->time)->format('H:i');
        $this->isUpdating = true;

        $this->dispatchBrowserEvent('form-modal-loaded', ['modalId' => 'apptModal']);
    }

    public function loadNewApptModal()
    {
        $this->resetFields();

        $this->dispatchBrowserEvent('form-modal-loaded', ['modalId' => 'apptModal']);
    }

    public function updatedCustomer($value)
    {
        $activeCustomer = Customer::find($value);
        $this->pets = isset($activeCustomer) ? $activeCustomer->getPetsAsOptions() : [];
        $this->petId = array_key_first($this->pets);
    }

    public function updatedActiveDate($value)
    {
        $this->date = $value;
        $this->loadAppointments();
    }

    /**
     * Save the model
     *
     * @return void
     */
    public function saveAppointment()
    {
        $this->appointment->time = Carbon::parse($this->date . ' ' . $this->time)->format('Y-m-d H:i:s');
        $this->appointment->customer_id = $this->customer;
        $this->appointment->pet_id = $this->petId;
        $this->validate($this->appointmentRules());

        $this->appointment->save();

        $this->activeDate = $this->date;
        $this->loadAppointments();

        $this->dispatchBrowserEvent('form-modal-saved', ['modalId' => 'apptModal']);

        $this->showMessage();
    }

    public function save()
    {
        // 
    }

    public function deleteAppt()
    {
        $this->appointment->delete();
        $this->resetFields();

        $this->loadAppointments();
        
        $this->dispatchBrowserEvent('form-modal-saved', ['modalId' => 'apptModal']);

        $this->showMessage('Rendez-vous supprimé');
    }

    public function previousDay()
    {
        $this->date = Carbon::parse($this->activeDate)->subDay()->startOfDay()->format('Y-m-d');
        $this->activeDate = $this->date;
        $this->loadAppointments();
    }

    public function nextDay()
    {
        $this->date = Carbon::parse($this->activeDate)->addDay()->startOfDay()->format('Y-m-d');
        $this->activeDate = $this->date;
        $this->loadAppointments();
    }

    private function loadAppointments()
    {
        $this->appointments = Appointment::whereBetween('time', [
            Carbon::parse($this->date)->startOfDay(),
            Carbon::parse($this->date)->endOfDay()
        ])->orderBy('time')->get();
    }

    private function resetFields()
    {
        $this->appointment = new Appointment;
        $this->appointment->status = 'planned';
        $this->customer = null;
        $this->pets = [];
        $this->petId = null;
        $this->modalTitle = 'Nouveau rendez-vous';
        $this->isUpdating = false;
        $this->time = '08:30';
        $this->pet = null;
    }
}
