<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use Illuminate\Contracts\View\View;

class PetsController extends Controller
{
    /**
     * Show pets index
     *
     * @return View
     */
    public function index(): View
    {
        return view('manager.pets.list');
    }

    /**
     * Show pet creation interface
     *
     * @return View
     */
    public function create(): View
    {
        return view('manager.pets.form', [
            'pet' => new Pet(),
        ]);
    }

    /**
     * Show pet edition interface
     *
     * @param Pet $pet
     * @return View
     */
    public function edit(Pet $pet): View
    {
        return view('manager.pets.form', [
            'pet' => $pet,
        ]);
    }

    /**
     * Show pet appointments list
     *
     * @param Pet $pet
     * @return View
     */
    public function appointments(Pet $pet): View
    {
        return view('manager.pets.appointments', [
            'pet' => $pet,
        ]);
    }

    /**
     * Show pet specified appointment
     *
     * @param Pet $pet
     * @return View
     */
    public function appointment(Pet $pet): View
    {
        return view('manager.appointments.form', [
            'appointment' => new Appointment(),
            'customer' => $pet->customer,
            'pet' => $pet,
        ]);
    }

    /**
     * Show pet gallery
     *
     * @param Pet $pet
     * @return View
     */
    public function gallery(Pet $pet): View
    {
        return view('manager.pets.gallery', [
            'pet' => $pet,
        ]);
    }
}
