<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function dashboard(): View
    {
        $todayCount = $this->getAppointmentsCountForToday();
        $reminders = $this->getTomorrowReminders();

        return view('manager.dashboard', [
            'user' => Auth::user(),
            'todayCount' =>  $todayCount,
            'reminders' => $reminders,
            'isWeekend' => $this->isWeekend(),
        ]);
    }

    /**
     * Get count of appointments for today.
     *
     * @return integer
     */
    private function getAppointmentsCountForToday(): int
    {
        return Appointment::query()
            ->whereBetween('time', [
                Carbon::today()->startOfDay(),
                Carbon::today()->endOfDay()
            ])
            ->count();
    }

    /**
     * Get dogs and owners who have appointments tomorrow and need remaining.
     * If current day is weekend, display monday remainings.
     *
     * @return Collection
     */
    private function getTomorrowReminders(): Collection
    {
        $from = Carbon::tomorrow()->startOfDay();
        $to = Carbon::tomorrow()->endOfDay();

        if ($this->isWeekend()) {
            $from = Carbon::parse('next monday')->startOfDay();
            $to = Carbon::parse('next monday')->endOfDay();
        }

        return Appointment::query()
            ->join('dogs', 'appointments.dog_id', '=', 'dogs.id')
            ->join('owners', 'dogs.owner_id', '=', 'owners.id')
            ->whereBetween('time', [$from, $to])
            ->where('owners.has_reminder', true)
            ->select(
                'appointments.id',
                'owners.name as owner_name',
                'owners.phone',
                'dogs.name',
            )
            ->get();
    }

    /**
     * Check if current day is friday or later.
     *
     * @return boolean
     */
    private function isWeekend(): bool
    {
        return Carbon::today()->getDaysFromStartOfWeek() >= 4;
    }
}
