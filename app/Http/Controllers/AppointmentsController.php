<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Contracts\View\View;

class AppointmentsController extends Controller
{
    /**
     * Edit appointment
     *
     * @param Appointment $appointment
     * @return View
     */
    public function edit(Appointment $appointment): View
    {
        return view('manager.appointments.form', [
            'appointment' => $appointment,
            'customer' => $appointment->customer,
            'pet' => $appointment->pet,
        ]);
    }
}
