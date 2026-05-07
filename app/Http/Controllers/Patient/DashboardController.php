<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $appointments = Appointment::where('patient_id', $user->id)->with('doctor')->get();

        $stats = [
            'total'             => $appointments->count(),
            'pending'           => $appointments->where('status', 'pending')->count(),
            'accepted'          => $appointments->where('status', 'accepted')->count(),
            'completed'         => $appointments->where('status', 'completed')->count(),
            'doctors_consulted' => $appointments->pluck('doctor_id')->unique()->count(),
        ];

        $recentAppointments = $appointments->sortByDesc('date')->take(5);

        return view('patient.dashboard', compact('user', 'stats', 'recentAppointments'));
    }
}