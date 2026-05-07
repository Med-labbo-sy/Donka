<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $appointments = Appointment::where('doctor_id', $user->id)->with('patient')->get();

        $stats = [
            'total'          => $appointments->count(),
            'pending'        => $appointments->where('status', 'pending')->count(),
            'accepted'       => $appointments->where('status', 'accepted')->count(),
            'completed'      => $appointments->where('status', 'completed')->count(),
            'patients_count' => $appointments->pluck('patient_id')->unique()->count(),
        ];

        $pendingAppointments = $appointments
            ->where('status', 'pending')
            ->sortBy('date')
            ->take(5);

        return view('doctor.dashboard', compact('user', 'stats', 'pendingAppointments'));
    }
}