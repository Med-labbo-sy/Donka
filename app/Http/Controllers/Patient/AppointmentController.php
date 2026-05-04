<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Liste des médecins disponibles
    public function create()
    {
        $doctors = User::where('role', 'doctor')->with('doctorProfile')->get();
        return view('patient.appointments.create', compact('doctors'));
    }

    // Prendre un RDV
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date'      => 'required|date|after:today',
            'time'      => 'required',
        ]);

        Appointment::create([
            'patient_id' => auth()->id(),
            'doctor_id'  => $request->doctor_id,
            'date'       => $request->date,
            'time'       => $request->time,
            'status'     => 'pending',
        ]);

        return redirect()->route('patient.appointments.index')
                         ->with('success', 'Rendez-vous demandé avec succès !');
    }

    // Liste des RDV du patient
    public function index()
    {
        $appointments = Appointment::where('patient_id', auth()->id())
                                   ->with('doctor')
                                   ->orderBy('date', 'desc')
                                   ->get();
        return view('patient.appointments.index', compact('appointments'));
    }

    // Annuler un RDV
    public function cancel(Appointment $appointment)
    {
        if ($appointment->patient_id !== auth()->id()) {
            abort(403);
        }
        $appointment->update(['status' => 'cancelled']);
        return back()->with('success', 'Rendez-vous annulé.');
    }
}
