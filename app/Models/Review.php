<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['appointment_id', 'patient_id', 'doctor_id', 'rating', 'comment'])]
class Review extends Model
{
    public function patient() { return $this->belongsTo(User::class, 'patient_id'); }
    public function doctor()  { return $this->belongsTo(User::class, 'doctor_id'); }
    public function appointment() { return $this->belongsTo(Appointment::class); }
}