<?php

namespace App\Traits\Livewire\CRUD;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Dog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait ReactiveAppointment
{
    public ?Appointment $appointment = null;

    // Modal
    public bool $isUpdating = false;
    public bool $isModalXl = false;
    public string $apptDate;
    public string $apptTime;
    public int $activeStep = 1;
    // Dog
    public int $dogId = 0;
    public ?string $dogName = null;
    public ?string $ownerName = null;
    public ?string $dogDetails = null;
    public ?int $selectedDog = null;
    // Appointment
    public int $apptId = 0;
    public ?string $apptNotes = null;
    public ?string $apptStatus = null;
    public ?string $apptPrice = null;
    // Duration
    public int $hours = 0;
    public int $minutes = 0;

    /**
     * Load modal to display existing appointment details.
     *
     * @param integer $id
     * @return void
     */
    public function loadApptModal(int $id)
    {
        $this->resetAppointment();
        $this->appointment = Appointment::with('dog')->findOrFail($id);

        $this->isUpdating = true;
        $this->isModalXl = $this->appointment->dog->has_warning;

        $this->apptDate = Carbon::parse($this->appointment->time)->format('Y-m-d');
        $this->apptTime = Carbon::parse($this->appointment->time)->format('H:i');
        $this->dogId = $this->appointment->dog->id;
        $this->dogName = $this->appointment->dog->name;
        $this->dogDetails = $this->appointment->dog->details;
        $this->apptId = $this->appointment->id;
        $this->apptNotes = $this->appointment->notes;
        $this->apptStatus = $this->appointment->status;
        $this->apptPrice = $this->appointment->price;
        $this->formatDuration();

        $this->showModal('apptModal');
    }

    /**
     * Prepare data and load modal for appointment creation.
     *
     * @return void
     */
    public function loadCreateApptModal(?int $dogId = null)
    {
        $this->resetAppointment();

        // Create appointment in dog appointments list.
        if ($dogId !== null) {
            $dog = Dog::findOrFail($dogId);
            $this->dogId = $dogId;
            $this->dogName = $dog->name;
            $this->ownerName = $dog->owner->name;
        }

        $this->apptStatus = $this->statuses[0]['value'];
        $this->showModal('createApptModal');
    }

    /**
     * Create new appointment.
     *
     * @return void
     */
    public function saveAppointment()
    {
        $dog = Dog::findOrFail($this->dogId);
        $duration = $dog->getDurationInHoursMinutes();

        Appointment::create([
            'dog_id' => $dog->id,
            'time' => Carbon::parse($this->apptDate . ' ' . $this->apptTime)->format('Y-m-d H:i:s'),
            'price' => null,
            'notes' => $this->apptNotes,
            'status' => $this->apptStatus,
            'duration' => intval($duration['hours'] * 60) + intval($duration['minutes']),
        ]);

        $this->showSuccessMessage();
        $this->hideModal('createApptModal');
    }

    /**
     * Reset values for appointement.
     *
     * @return void
     */
    public function resetAppointment()
    {
        $this->activeStep = 1;
        $this->appointment = null;
        $this->apptDate = $this->date;
        $this->apptId = 0;
        $this->apptNotes = null;
        $this->apptPrice = null;
        $this->apptStatus = null;
        $this->apptTime = Appointment::DEFAULT_TIME;
        $this->dogDetails = null;
        $this->dogId = 0;
        $this->dogName = null;
        $this->dogs = null;
        $this->isModalXl = false;
        $this->isUpdating = false;
        $this->ownerName = null;
        $this->search = null;
        $this->selectedDog = null;
        $this->hours = 0;
        $this->minutes = 0;
    }

    /**
     * Delete active appointment.
     *
     * @return void
     */
    public function deleteAppointment()
    {
        $this->appointment->delete();
        $this->resetAppointment();
        $this->showSuccessMessage();
        $this->hideModal('apptModal');
    }

    /**
     * Live updating Appointment attributes
     *
     * @param string $name
     * @param string|integer|boolean $value
     * @return void
     */
    protected function liveUpdateAppointment(string $name, string|int|bool $value)
    {
        try {
            // "if" is used to avoind unwanted update when closing modals.
            if ($this->appointment?->id !== null) {
                switch ($name) {
                    case 'apptDate':
                    case 'apptTime':
                        $this->appointment->update([
                            'time' => Carbon::parse($this->apptDate . ' ' . $this->apptTime)->format('Y-m-d H:i:s'),
                        ]);
                        break;

                    case 'apptStatus':
                        $this->appointment->update([
                            'status' => $value,
                        ]);
                        break;

                    case 'apptPrice':
                        $this->appointment->update([
                            'price' => $value === '' ? null : $value,
                        ]);
                        break;

                    case 'apptNotes':
                        $this->appointment->update([
                            'notes' => $value,
                        ]);
                        break;

                    case 'hours':
                    case 'minutes':
                        // Update duration
                        $this->appointment->update([
                            'duration' => $this->setDurationInMinutes(),
                        ]);

                        $this->formatDuration();
                        break;

                }
            }
        } catch (\Throwable $th) {
            Log::error($th);
            $this->showErrorMessage();
        }
    }

    /**
     * Return validation rules for reactive appointment.
     *
     * @return array
     */
    public static function getValidationRules(): array
    {
        return [
            'date' => 'required|string',

            // Dog
            'apptStatus' => 'required|string|in:' . AppointmentStatus::getValidationInRuleValues(),
            'apptTime' => 'required|string',
            'apptPrice' => 'nullable|numeric|min:0',
            'apptNotes' => 'nullable|string',

            // Duration
            'hours' => 'nullable|integer',
            'minutes' => 'nullable|integer',
        ];
    }

    /**
     * Get appointment duration and format it to hours and minutes.
     *
     * @return void
     */
    private function formatDuration()
    {
        $duration = $this->appointment?->duration !== null
            ? $this->appointment->getDurationInHoursMinutes()
            : $this->appointment->dog->getDurationInHoursMinutes();

        $this->hours = $duration['hours'];
        $this->minutes = $duration['minutes'];
    }

    /**
     * Format duration in minutes to be compatible for saving.
     * *?? 0* is used to set to 0 if input is empty.
     *
     * @return integer
     */
    private function setDurationInMinutes(): int
    {
        return intval(($this?->hours ?? 0) * 60) + intval($this?->minutes ?? 0);
    }
}
