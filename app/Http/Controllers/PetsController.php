<?php

namespace App\Http\Controllers;

use App\DataTables\PetsDataTable;
use App\Models\Customer;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PetsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show pets table
     *
     * @param PetsDataTable $dataTable
     * @return view
     */
    public function index(PetsDataTable $dataTable)
    {
        return $dataTable->render('customers.pets.index');
    }
    
    /**
     * Show pet creation interface
     *
     * @return view
     */
    public function create()
    {
        return view('customers.pets.form', [
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
        Pet::create([
            'uuid' => Str::uuid(),
            'customer_id' => $request->customer,
            'name' => $request->name,
            'birthdate' => Carbon::parse($request->birthdate)->format('Y-m-d'),
            'status' => $request->status,
            'average_duration' => ($request->hours * 60) + $request->minutes,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('pets')->with('status', 'Enregistrement de ' . $request->name . ' réussi !');
    }

    /**
     * Show pet edition interface
     *
     * @param Pet $pet
     * @return view
     */
    public function edit(Pet $pet)
    {
        return view('customers.pets.form', [
            'pet' => $pet,
            'statusItems' => Pet::getStatus(),
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
        //dd($request->all());
        $pet = Pet::where('uuid', $request->petID);
        $pet->update([
            'customer_id' => $request->customer,
            'name' => $request->name,
            'birthdate' => Carbon::parse($request->birthdate)->format('Y-m-d'),
            'status' => $request->status,
            'average_duration' => ($request->hours * 60) + $request->minutes,
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
