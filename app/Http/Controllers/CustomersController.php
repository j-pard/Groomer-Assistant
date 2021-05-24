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
     * Show customers index
     *
     * @return view
     */
    public function index()
    {
        return view('manager.customers.index');
    }
    
    /**
     * Show customer creation interface
     *
     * @return view
     */
    public function create()
    {
        return view('manager.customers.form', [
            'customer' => null
        ]);
    }

    /**
     * Store new customer
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
     * Show customer edition interface
     *
     * @param Customer $customer
     * @return view
     */
    public function edit(Customer $customer)
    {
        return view('manager.customers.form', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update existing customer
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
     * Delete existing customer
     *
     */
    public function delete(Request $request)
    {
        $customer = Customer::find($request->customerId);

        if ($customer->pets()->count() > 0 || $customer->appointments()->count() > 0) {
            return redirect()->back()->with('error', 'Suppression impossible, il existe des données pour ce client.');
        }

        $customer->delete();
        
        return redirect()->route('customers')->with('status', 'Suppression réussie !');
    }

    /**
     * Attach specified pet to specified customer
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
     * Detach specified pet to specified customer
     *
     * @param Request $request
     */
    public function detachPet(Request $request)
    {
        Pet::where([
            'id' => $request->petId,
            'customer_id' => $request->customerId,
        ])->update([
            'customer_id' => null
        ]);

        return redirect()->back()->with('status', 'Propriétaire enlevé avec succès.');
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
