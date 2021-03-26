<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('manager.home', [
            'appointments' => Appointment::whereBetween('time', [
                Carbon::now()->startOfDay(),
                Carbon::now()->endOfDay()
            ])->get()
        ]);
    }
}
