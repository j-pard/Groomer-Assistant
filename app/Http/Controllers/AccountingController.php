<?php

namespace App\Http\Controllers;

class AccountingController extends Controller
{
    /**
     * Show customers index
     *
     * @return view
     */
    public function index()
    {
        return view('manager.accounting.index');
    }
}
