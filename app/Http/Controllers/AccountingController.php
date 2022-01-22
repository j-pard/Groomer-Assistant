<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class AccountingController extends Controller
{
    /**
     * Show customers index
     *
     * @return View
     */
    public function index(): View
    {
        return view('manager.accounting.index');
    }
}
