<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Liste de tous les RDV du médecin
    public function index(Request $request)
    {
        $query = Appointment::where('doctor_id', auth()->id())->with('patient');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->date) {
            $query->where('date', $request->date);
        }

        $appointments = $query->orderBy('date', 'asc')->get();
        return view('doctor.appointments.index', compact('appointments'));
    }

    // Accepter un RDV
    public function accept(Appointment $appointment)
    {
        $appointment->update(['status' => 'accepted']);
        return back()->with('success', 'Rendez-vous accepté.');
    }

    // Refuser un RDV
    public function refuse(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);
        return back()->with('success', 'Rendez-vous refusé.');
    }

    // Marquer comme terminé + ajouter notes
    public function complete(Request $request, Appointment $appointment)
    {
        $request->validate(['notes' => 'nullable|string']);
        $appointment->update([
            'status' => 'completed',
            'notes'  => $request->notes,
        ]);
        return back()->with('success', 'Rendez-vous marqué comme terminé.');
    }
}