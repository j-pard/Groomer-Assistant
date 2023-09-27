<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Contracts\View\View;

class DogsController extends Controller
{
    /**
     * Show dog details.
     *
     * @return View
     */
    public function show(Dog $dog): View
    {
        return view('manager.dogs.form', [
            'dog' => $dog,
        ]);
    }
}
