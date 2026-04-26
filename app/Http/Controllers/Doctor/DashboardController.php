<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('doctor.dashboard', compact('user'));
    }
}