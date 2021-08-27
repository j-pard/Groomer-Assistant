<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function breeds()
    {
        return view('manager.settings.breeds.list');
    }
}
