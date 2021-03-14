<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\Customer;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PetsController extends Controller
{
    /**
     * Show pets index
     *
     * @return view
     */
    public function index()
    {
        return view('manager.pets.index');
    }
    
    /**
     * Show pet creation interface
     *
     * @return view
     */
    public function create()
    {
        return view('manager.pets.form', [
            'statusItems' => Pet::getStatus(),
            'customers' => Customer::all(),
        ]);
    }

    /**
     * Store new pet
     *
     */
    public function store(Request $request)
    {
        $pet = Pet::create([
            'uuid' => Str::uuid(),
            'customer_id' => $request->customer,
            'name' => $request->name,
            'genre' => $request->genre,
            'main_breed_id' => isset($request->mainBreed) ? $request->mainBreed : null,
            'second_breed_id' => isset($request->secondBreed) ? $request->secondBreed : null,
            'birthdate' => Carbon::parse($request->birthdate)->format('Y-m-d'),
            'status' => $request->status,
            'average_duration' => ($request->hours * 60) + $request->minutes,
            'size' => $request->size,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('editPet', ['pet' => $pet])
            ->with('status', 'Enregistrement de ' . $request->name . ' réussi !');
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
            'customers' => Customer::all(),
            'duration' => $pet->getDurationInHoursMinutes(),
        ]);
    }

    /**
     * Update existing pet
     *
     */
    public function update(Request $request)
    {
        Pet::where('uuid', $request->petID)->update([
            'customer_id' => $request->customer,
            'name' => $request->name,
            'genre' => $request->genre,
            'main_breed_id' => isset($request->mainBreed) ? $request->mainBreed : null,
            'second_breed_id' => isset($request->secondBreed) ? $request->secondBreed : null,
            'birthdate' => Carbon::parse($request->birthdate)->format('Y-m-d'),
            'status' => $request->status,
            'average_duration' => ($request->hours * 60) + $request->minutes,
            'size' => $request->size,
            'remarks' => $request->remarks,
        ]);

        return redirect()->back()->with('status', 'Mise à jour de ' . $request->name . ' réussie !');
    }

    /**
     * Delete existing pet
     *
     */
    public function delete()
    {

    }
}
