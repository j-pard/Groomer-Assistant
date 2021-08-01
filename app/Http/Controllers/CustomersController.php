<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Http\Request;

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
            'customer' => new Customer,
        ]);
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
     * Show customer appointments list
     *
     * @param Customer $customer
     * @return view
     */
    public function appointments(Customer $customer)
    {
        return view('manager.customers.appointments', [
            'customer' => $customer,
        ]);
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
        
        return redirect()->route('customers.index')->with('status', 'Suppression réussie !');
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
     * Return related pets as options list
     * Specific method for dynamic appointments
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
