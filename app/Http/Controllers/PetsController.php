<?php

namespace App\Http\Controllers;

use App\DataTables\PetsDataTable;
use App\Models\Pet;
use Illuminate\Http\Request;

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

    public function index(PetsDataTable $dataTable)
    {
        return $dataTable->render('customers.pets.index');
    }
    

    public function create()
    {
        return view('customers.pets.form');
    }

    public function edit(Pet $pet)
    {
        return view('customers.pets.form', [
            'pet' => $pet,
        ]);
    }
}
