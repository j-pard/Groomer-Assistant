<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    /**
     * Edit appointment
     *
     * @param Appointment $appointment
     * @return view
     */
    public function edit(Appointment $appointment)
    {
        return view('manager.appointments.form', [
            'appointment' => $appointment,
            'customer' => $appointment->customer,
            'pet' => $appointment->pet,
        ]);
    }

    /**
     * Store new appointment
     *
     */
    public function store(Request $request)
    {
        $datetime = $request->date . ' ' . $request->time;

        Appointment::create([
            'customer_id' => $request->customer,
            'pet_id' => $request->pet,
            'time' => Carbon::createFromFormat('Y-m-d H:i', $datetime, 'Europe/Brussels')->toDateTimeString(),
            'notes' => $request->notes,
        ]);

        return redirect()->back()
            ->with('status', 'Rendez-vous ajouté.');
    }

    /**
     * Update existing pet
     *
     */
    public function update(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $datetime = $request->date . ' ' . $request->time;
        
        $appointment->update([
            'time' => Carbon::createFromFormat('Y-m-d H:i', $datetime, 'Europe/Brussels')->toDateTimeString(),
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        return redirect()->back()
            ->with('status', 'Rendez-vous mit à jour.');
    }
}
