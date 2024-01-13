<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Contracts\View\View;

class CustomersController extends Controller
{
    /**
     * Show customers index
     *
     * @return view
     */
    public function index(): View
    {
        return view('manager.customers.list');
    }

    /**
     * Show customer creation interface
     *
     * @return view
     */
    public function create(): View
    {
        return view('manager.customers.form', [
            'customer' => new Customer(),
        ]);
    }

    /**
     * Show customer edition interface
     *
     * @param Customer $customer
     * @return view
     */
    public function edit(Customer $customer): View
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
    public function appointments(Customer $customer): View
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
    public function appointment(Customer $customer): View
    {
        return view('manager.appointments.form', [
            'appointment' => new Appointment(),
            'customer' => $customer,
            'pet' => new Pet(),
        ]);
    }
}
