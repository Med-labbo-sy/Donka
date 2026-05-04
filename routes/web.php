<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DoctorController;

// Pages publiques
Route::get('/', [PageController::class, 'home']);
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{user}', [DoctorController::class, 'show'])->name('doctors.show');

// Routes authentifiées
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/doctor/dashboard', [App\Http\Controllers\Doctor\DashboardController::class, 'index'])->name('doctor.dashboard');
    Route::get('/patient/dashboard', [App\Http\Controllers\Patient\DashboardController::class, 'index'])->name('patient.dashboard');

    // Profil médecin
    Route::get('/doctor/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'edit'])->name('doctor.profile');
    Route::put('/doctor/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'update'])->name('doctor.profile.update');

    // RDV Patient
    Route::get('/patient/appointments', [App\Http\Controllers\Patient\AppointmentController::class, 'index'])->name('patient.appointments.index');
    Route::get('/patient/appointments/create', [App\Http\Controllers\Patient\AppointmentController::class, 'create'])->name('patient.appointments.create');
    Route::post('/patient/appointments', [App\Http\Controllers\Patient\AppointmentController::class, 'store'])->name('patient.appointments.store');
    Route::patch('/patient/appointments/{appointment}/cancel', [App\Http\Controllers\Patient\AppointmentController::class, 'cancel'])->name('patient.appointments.cancel');

    // RDV Médecin
    Route::get('/doctor/appointments', [App\Http\Controllers\Doctor\AppointmentController::class, 'index'])->name('doctor.appointments.index');
    Route::patch('/doctor/appointments/{appointment}/accept', [App\Http\Controllers\Doctor\AppointmentController::class, 'accept'])->name('doctor.appointments.accept');
    Route::patch('/doctor/appointments/{appointment}/refuse', [App\Http\Controllers\Doctor\AppointmentController::class, 'refuse'])->name('doctor.appointments.refuse');
    Route::patch('/doctor/appointments/{appointment}/complete', [App\Http\Controllers\Doctor\AppointmentController::class, 'complete'])->name('doctor.appointments.complete');

    // Messages Patient
    Route::get('/patient/messages', [App\Http\Controllers\Patient\MessageController::class, 'index'])->name('patient.messages.index');
    Route::get('/patient/messages/{doctorId}', [App\Http\Controllers\Patient\MessageController::class, 'show'])->name('patient.messages.show');
    Route::post('/patient/messages/{conversation}', [App\Http\Controllers\Patient\MessageController::class, 'store'])->name('patient.messages.store');
    
    // Messages Médecin
    Route::get('/doctor/messages', [App\Http\Controllers\Doctor\MessageController::class, 'index'])->name('doctor.messages.index');
    Route::get('/doctor/messages/{conversation}', [App\Http\Controllers\Doctor\MessageController::class, 'show'])->name('doctor.messages.show');
    Route::post('/doctor/messages/{conversation}', [App\Http\Controllers\Doctor\MessageController::class, 'store'])->name('doctor.messages.store');
});

require __DIR__.'/auth.php';