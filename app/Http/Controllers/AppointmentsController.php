<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppointmentsController extends Controller
{
    /**
     * Store new appointment
     *
     */
    public function store(Request $request)
    {
        $datetime = $request->date . ' ' . $request->time;
        //dd($datetime);
        Appointment::create([
            'customer_id' => $request->customer,
            'pet_id' => $request->pet,
            'time' => Carbon::createFromFormat('Y-m-d H:i', $datetime, 'Europe/Brussels')->toDateTimeString(),
            'notes' => $request->notes,
        ]);

        return redirect()->route('home')
            ->with('status', 'Rendez-vous ajouté.');
    }

    /**
     * Update existing pet
     *
     */
    public function update(Request $request)
    {
        $appointment = Appointment::find($request->id);

        $appointment->update([
            'time' => Carbon::parse($request->date . ' ' . $request->time),
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        return redirect()->back()
            ->with('status', 'Rendez-vous mit à jour.');
    }
}
