<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        // 1. Statistics
        $totalRevenue = Appointment::where('status', 'completed')->sum('total_price');
        $appointmentsToday = Appointment::whereDate('appointment_date', $today)->count();
        $totalBarbers = Barber::where('is_active', true)->count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();

        // 2. Today's Schedule (Quick View)
        $todaysSchedule = Appointment::with(['user', 'barber', 'service'])
            ->whereDate('appointment_date', $today)
            ->where('status', '!=', 'cancelled')
            ->orderBy('start_time')
            ->get();

        return view('admin.dashboard.index', compact(
            'totalRevenue',
            'appointmentsToday',
            'totalBarbers',
            'pendingAppointments',
            'todaysSchedule'
        ));
    }
}
