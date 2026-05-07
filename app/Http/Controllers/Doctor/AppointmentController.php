<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Helpers\NotificationHelper;

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

    

    

    public function accept(Appointment $appointment)
    {
        $appointment->update(['status' => 'accepted']);
        NotificationHelper::send(
            $appointment->patient_id,
            'Rendez-vous accepté',
            'Dr. ' . auth()->user()->name . ' a accepté votre rendez-vous du ' . $appointment->date,
            'appointment'
            );
            return back()->with('success', 'Rendez-vous accepté.');
            }

    public function refuse(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);
        NotificationHelper::send(
            $appointment->patient_id,
            'Rendez-vous refusé',
            'Dr. ' . auth()->user()->name . ' a refusé votre rendez-vous du ' . $appointment->date,
            'appointment'
            );
            return back()->with('success', 'Rendez-vous refusé.');
            }

    public function complete(Request $request, Appointment $appointment)
    {
        $request->validate(['notes' => 'nullable|string']);
        $appointment->update(['status' => 'completed', 'notes' => $request->notes]);
        NotificationHelper::send(
            $appointment->patient_id,
            'Consultation terminée',
            'Votre rendez-vous avec Dr. ' . auth()->user()->name . ' est terminé. Laissez un avis !',
            'appointment'
            );
            return back()->with('success', 'Rendez-vous terminé.');
            }
    
}