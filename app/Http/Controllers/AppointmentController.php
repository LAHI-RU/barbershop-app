<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\Service;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->is_admin) {
            $appointments = Appointment::with(['user', 'barber', 'service'])
                ->latest('appointment_date')
                ->latest('start_time')
                ->paginate(15);
            return view('admin.appointments.index', compact('appointments'));
        }

        $appointments = $user->appointments()
            ->with(['barber', 'service'])
            ->latest('appointment_date')
            ->latest('start_time')
            ->get();
            
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        $barbers = Barber::where('is_active', true)->get();
        $services = Service::where('is_active', true)->get();
        return view('appointments.create', compact('barbers', 'services'));
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $barber = Barber::findOrFail($request->barber_id);
        $service = Service::findOrFail($request->service_id);
        $date = $request->appointment_date;
        $startTime = $request->start_time;
        
        // Calculate end time
        $end = Carbon::createFromFormat('H:i', $startTime)->addMinutes($service->duration_minutes);
        $endTime = $end->format('H:i');

        // Conflict check logic (simple version)
        $conflict = Appointment::where('barber_id', $barber->id)
            ->where('appointment_date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function ($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                      });
            })
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($conflict) {
            return back()->withErrors(['start_time' => 'This barber is already booked for this time slot.'])->withInput();
        }

        Appointment::create([
            'user_id' => auth()->id(),
            'barber_id' => $barber->id,
            'service_id' => $service->id,
            'appointment_date' => $date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $service->price,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully! It is currently pending confirmation.');
    }

    /**
     * Update the status of an appointment (Admin only).
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Appointment status updated to ' . ucfirst($request->status) . '.');
    }
}
