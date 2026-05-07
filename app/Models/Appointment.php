<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['patient_id', 'doctor_id', 'date', 'time', 'status', 'notes'])]

class Appointment extends Model
{
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function review() { return $this->hasOne(Review::class); }
}