<?php

namespace App\Http\Livewire\Appointments;

use App\Http\Livewire\Form as LivewireForm;
use App\Models\Appointment;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Index extends LivewireForm
{
    public Collection $appointments;
    public ?Appointment $appointment = null;
    public array $pets = [];
    public ?string $petId = null;
    public ?Pet $pet;
    public array $status = [];

    public string $date;
    public string $time;
    public string $activeDate;
    public string $modalTitle;
    public bool $isUpdating = false;

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
        $this->pets = $this->getAllPetsAsOptions();
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
    
    protected function appointmentRules()
    {
        return [
            'appointment.pet_id' => 'required|string',
            'appointment.time' => 'required|string',
            'appointment.price' => 'nullable|numeric|min:0',
            'appointment.notes' => 'nullable|string',
            'appointment.status' => 'required|string',

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

    public function loadApptModal($id)
    {
        $this->appointment = Appointment::find($id);
        $this->customer = $this->appointment->customer_id;
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
        $this->petId = $this->pets[0]['value'] ?? null;

        $this->dispatchBrowserEvent('form-modal-loaded', ['modalId' => 'apptModal']);
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
        $this->pet = Pet::findOrFail($this->petId);
        $this->appointment->customer_id = $this->pet->customer_id;
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
        $this->petId = null;
        $this->modalTitle = 'Nouveau rendez-vous';
        $this->isUpdating = false;
        $this->time = '08:30';
        $this->pet = null;
    }

    private function getAllPetsAsOptions()
    {
        return Pet::select(
                'pets.id',
                'pets.customer_id',
                'pets.name',
                'customers.firstname AS customer_firstname',
                'customers.lastname AS customer_lastname',
                'customers.phone AS customer_phone',
            )
            ->leftJoin('customers', 'customers.id', '=', 'pets.customer_id')
            ->orderBy('pets.name')
            ->get()
            ->map(function ($pet) {
                return [
                    'value' => $pet->id, 
                    'label' => $pet->name . ' - ' . $pet->customer_lastname . ' ' . $pet->customer_firstname . ' - ' . $pet->customer_phone,
                ];
            })
            ->toArray();
    }
}
