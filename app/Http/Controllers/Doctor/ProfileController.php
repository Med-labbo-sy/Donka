<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function edit()
{
    $user    = auth()->user();
    $profile = $user->doctorProfile()->firstOrCreate(['user_id' => $user->id]);
    return view('doctor.profile', compact('user', 'profile'));
}
    


    
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'             => 'required|string|max:255',
            'specialization'   => 'required|string|max:255',
            'consultation_fee' => 'required|numeric|min:0',
            'biography'        => 'nullable|string',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Mise à jour du nom
        $user->update(['name' => $request->name]);

        // Mise à jour du profil médecin
        $data = [
            'specialization'   => $request->specialization,
            'consultation_fee' => $request->consultation_fee,
            'biography'        => $request->biography,
        ];

        // Upload photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }

        $user->doctorProfile()->updateOrCreate(['user_id' => $user->id], $data);

        return back()->with('success', 'Profil mis à jour !');
    }
}