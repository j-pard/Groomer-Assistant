<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (isset($request->day)) {
            $day = Carbon::parse($request->day)->format('d-m-Y');
            $appointments = Appointment::whereBetween('time', [
                Carbon::parse($request->day)->startOfDay(),
                Carbon::parse($request->day)->endOfDay()
            ])->get();
        } else {
            $day = Carbon::now()->format('d-m-Y');
            $appointments = Appointment::whereBetween('time', [
                Carbon::now()->startOfDay(),
                Carbon::now()->endOfDay()
            ])->get();
        }

        return view('manager.home', [
            'appointments' => $appointments,
            'day' => $day,
        ]);
    }
}
