<?php
namespace App\Http\Controllers;

use App\Models\User;

class DoctorController extends Controller
{
    // Liste publique des médecins
    public function index()
    {
        $doctors = User::where('role', 'doctor')->with('doctorProfile')->get();
        return view('doctors.index', compact('doctors'));
    }

    // Profil public d'un médecin
    public function show(User $user)
    {
        $profile = $user->doctorProfile;
        return view('doctors.show', compact('user', 'profile'));
    }
}