<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function appointments()
    {
        $user = auth()->user();
        $appointments = Appointment::where('patient_id', $user->id)
                                   ->with('doctor')
                                   ->orderBy('date', 'desc')
                                   ->get();

        $pdf = Pdf::loadView('pdf.appointments', compact('user', 'appointments'));
        return $pdf->download('historique-rdv-' . $user->name . '.pdf');
    }
}