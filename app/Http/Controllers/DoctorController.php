<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'doctor')->with(['doctorProfile', 'reviews']);

        // Filtre par nom ou spécialisation
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhereHas('doctorProfile', fn($p) =>
                      $p->where('specialization', 'like', "%$search%")
                  );
            });
        }

        // Filtre par fourchette de prix
        if ($request->min_price) {
            $query->whereHas('doctorProfile', fn($p) =>
                $p->where('consultation_fee', '>=', $request->min_price)
            );
        }
        if ($request->max_price) {
            $query->whereHas('doctorProfile', fn($p) =>
                $p->where('consultation_fee', '<=', $request->max_price)
            );
        }

        $doctors = $query->get();

        // Filtre par note moyenne (après récupération)
        if ($request->min_rating) {
            $doctors = $doctors->filter(fn($d) =>
                $d->averageRating() >= $request->min_rating
            );
        }

        return view('doctors.index', compact('doctors'));
    }

    public function show(User $user)
    {
        $profile = $user->doctorProfile;
        $reviews = $user->reviews()->with('patient')->latest()->get();
        $avgRating = $user->averageRating();
        return view('doctors.show', compact('user', 'profile', 'reviews', 'avgRating'));
    }
}









