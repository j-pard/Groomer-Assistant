<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use Illuminate\Http\Request;

class SettingsController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('manager.settings.index', [
            'breeds' => [-1 => '---'] + Breed::all()->sortBy('breed')->pluck('breed', 'id')->toArray(),
        ]);
    }
}
