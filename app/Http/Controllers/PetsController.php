<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Breed;
use App\Models\Customer;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    /**
     * Show pets index
     *
     * @return view
     */
    public function index()
    {
        return view('manager.pets.list');
    }
    
    /**
     * Show pet creation interface
     *
     * @return view
     */
    public function create()
    {
        return view('manager.pets.form', [
            'pet' => new Pet,
        ]);
    }

    /**
     * Show pet edition interface
     *
     * @param Pet $pet
     * @return view
     */
    public function edit(Pet $pet)
    {
        return view('manager.pets.form', [
            'pet' => $pet,
        ]);
    }

    /**
     * Show pet appointments list
     *
     * @param Pet $pet
     * @return view
     */
    public function appointments(Pet $pet)
    {
        return view('manager.pets.appointments', [
            'pet' => $pet,
        ]);
    }

    /**
     * Show pet specified appointment
     *
     * @param Pet $pet
     * @return view
     */
    public function appointment(Pet $pet)
    {
        return view('manager.appointments.form', [
            'appointment' => new Appointment(),
            'customer' => $pet->customer,
            'pet' => $pet,
        ]);
    }

    /**
     * Show pet sheets
     *
     * @param Pet $pet
     * @return view
     */
    public function sheets(Pet $pet)
    {
        return view('manager.pets.sheets', [
            'pet' => $pet,
        ]);
    }
}
