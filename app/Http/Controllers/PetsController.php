<?php

namespace App\Http\Controllers;

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
            'pet' => null,
            'statusItems' => Pet::getStatus(),
            'customers' => Customer::orderBy('lastname')->orderBy('firstname')->get(),
            'breeds' => [-1 => '---'] + Breed::all()->sortBy('breed')->pluck('breed', 'id')->toArray(),
        ]);
    }

    /**
     * Store new pet
     *
     */
    public function store(Request $request)
    {
        $pet = Pet::create([
            'customer_id' => $request->customer,
            'name' => $request->name,
            'genre' => $request->genre,
            'main_breed_id' => isset($request->mainBreed) && $request->mainBreed != -1 ? $request->mainBreed : Breed::where('breed', 'Inconnu')->first()->id,
            'second_breed_id' => isset($request->secondBreed) && $request->secondBreed != -1 ? $request->secondBreed : null,
            'birthdate' => Carbon::parse($request->birthdate)->format('Y-m-d'),
            'status' => $request->status,
            'average_duration' => ($request->hours * 60) + $request->minutes,
            'size' => $request->size,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('pets.edit', ['pet' => $pet])
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
            'customers' => Customer::orderBy('lastname')->orderBy('firstname')->get(),
            'duration' => $pet->getDurationInHoursMinutes(),
            'breeds' => [-1 => '---'] + Breed::all()->sortBy('breed')->pluck('breed', 'id')->toArray(),
        ]);
    }

    /**
     * Update existing pet
     *
     */
    public function update(Request $request)
    {
        $pet = Pet::find($request->petID)->update([
            'customer_id' => $request->customer,
            'name' => $request->name,
            'genre' => $request->genre,
            'main_breed_id' => isset($request->mainBreed) && $request->mainBreed != -1 ? $request->mainBreed : Breed::where('breed', 'Inconnu')->first()->id,
            'second_breed_id' => isset($request->secondBreed) && $request->secondBreed != -1 ? $request->secondBreed : null,
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
    public function delete(Request $request)
    {
        Pet::find($request->petId)->delete();

        return redirect()->route('pets.index')->with('status', 'Suppression réussie !');
    }
}
