<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Contracts\View\View;

class DogsController extends Controller
{
    /**
     * Show dogs list.
     *
     * @return View
     */
    public function list(): View
    {
        $query = Dog::query()
            ->with('mainBreed', 'secondBreed')
            ->orderBy('name', 'ASC')
            ->orderBy('owner_name', 'ASC')
            ->paginate(20);
        
        return view('manager.dogs.list', [
            'dogs' => $query,
        ]);
    }
}
