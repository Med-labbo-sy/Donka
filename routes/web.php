<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;

Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/students', [StudentController::class, 'index']);



Route::get('/doctor/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'edit'])
   ->name('doctor.profile');
Route::put('/doctor/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'update'])
   ->name('doctor.profile.update'); 


Route::middleware(['auth'])->group(function () {

    Route::get('/doctor/dashboard', [App\Http\Controllers\Doctor\DashboardController::class, 'index'])
         ->name('doctor.dashboard');

    Route::get('/patient/dashboard', [App\Http\Controllers\Patient\DashboardController::class, 'index'])
         ->name('patient.dashboard');
    

});


require __DIR__.'/auth.php';