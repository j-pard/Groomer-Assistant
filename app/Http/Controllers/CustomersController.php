<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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
        return view('manager.customers.list');
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
     * Show customer specified appointment
     *
     * @param Customer $customer
     * @return view
     */
    public function appointment(Customer $customer)
    {
        return view('manager.appointments.form', [
            'appointment' => new Appointment,
            'customer' => $customer,
            'pet' => new Pet,
        ]);
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
