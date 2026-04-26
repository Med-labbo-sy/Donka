<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'specialization', 'consultation_fee', 'biography', 'photo'])]

class DoctorProfile extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}