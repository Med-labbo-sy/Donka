<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Review;
use App\Helpers\NotificationHelper;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Appointment $appointment)
    {
        if ($appointment->patient_id !== auth()->id() || $appointment->status !== 'completed') {
            abort(403);
        }
        if ($appointment->review) {
            return back()->with('error', 'Vous avez déjà noté ce rendez-vous.');
        }
        return view('patient.reviews.create', compact('appointment'));
    }

    public function store(Request $request, Appointment $appointment)
    {
        if ($appointment->patient_id !== auth()->id()) abort(403);

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'appointment_id' => $appointment->id,
            'patient_id'     => auth()->id(),
            'doctor_id'      => $appointment->doctor_id,
            'rating'         => $request->rating,
            'comment'        => $request->comment,
        ]);

        NotificationHelper::send(
            $appointment->doctor_id,
            'Nouvel avis reçu',
            auth()->user()->name . ' a laissé un avis ' . $request->rating . '★',
            'review'
        );

        return redirect()->route('patient.appointments.index')
                         ->with('success', 'Merci pour votre avis !');
    }
}