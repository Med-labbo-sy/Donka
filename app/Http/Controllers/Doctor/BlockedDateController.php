<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\BlockedDate;
use Illuminate\Http\Request;

class BlockedDateController extends Controller
{
    public function index()
    {
        $blocked = BlockedDate::where('doctor_id', auth()->id())
                              ->orderBy('date')
                              ->get();
        return view('doctor.blocked-dates', compact('blocked'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'   => 'required|date|after_or_equal:today',
            'reason' => 'nullable|string|max:255',
        ]);

        BlockedDate::firstOrCreate([
            'doctor_id' => auth()->id(),
            'date'      => $request->date,
        ], ['reason' => $request->reason]);

        return back()->with('success', 'Date bloquée.');
    }

    public function destroy(BlockedDate $blockedDate)
    {
        if ($blockedDate->doctor_id !== auth()->id()) abort(403);
        $blockedDate->delete();
        return back()->with('success', 'Date débloquée.');
    }
}