<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store new pet
     *
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show pet edition interface
     *
     * @param Pet $pet
     * @return view
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update existing pet
     *
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Delete existing pet
     *
     */
    public function delete()
    {

    }
}
