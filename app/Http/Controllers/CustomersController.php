<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomersController extends Controller
{
    /**
     * Show pets index
     *
     * @return view
     */
    public function index()
    {
        return view('manager.customers.index');
    }
    
    /**
     * Show pet creation interface
     *
     * @return view
     */
    public function create()
    {
        return view('manager.customers.form');
    }

    /**
     * Store new pet
     *
     */
    public function store(Request $request)
    {
        $customer = Customer::create([
            'uuid' => Str::uuid(),
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'genre' => $request->genre,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'secondary_phone' => $request->secondary_phone,
            'more_info' => $request->more_info,
        ]);

        return redirect()->route('editCustomer', ['customer' => $customer])
            ->with('status', 'Nouveau client ajouté.');
    }

    /**
     * Show pet edition interface
     *
     * @param Pet $pet
     * @return view
     */
    public function edit(Customer $customer)
    {
        return view('manager.customers.form', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update existing pet
     *
     */
    public function update(Request $request)
    {
        Customer::where('uuid', $request->customerID)->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'genre' => $request->genre,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'secondary_phone' => $request->secondary_phone,
            'more_info' => $request->more_info,
        ]);

        return redirect()->back()->with('status', 'Données mises à jour.');
    }

    /**
     * Delete existing pet
     *
     */
    public function delete()
    {

    }

    /**
     * Attach specified customer to specified pet
     *
     * @param Request $request
     */
    public function attachPet(Request $request)
    {
        Pet::find($request->petId)->update([
            'customer_id' => $request->customerId
        ]);

        return redirect()->back()->with('status', 'Propriétaire ajouté avec succès.');
    }

    /**
     * Return related pets as options list
     *
     * @param Request $request
     * @return array
     */
    public function getPetsOptions(Request $request)
    {
        $customer = Customer::find($request->customerId);

        if (isset($customer)) {
            return $customer->pets()->orderBy('name')->pluck('name', 'id');
        }

        return [];
    }
}
