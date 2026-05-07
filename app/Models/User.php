<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password','role'])]
#[Hidden(['password', 'remember_token'])]




class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function doctorProfile()
{
    return $this->hasOne(DoctorProfile::class);
}

    public function appointmentsAsPatient()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function appointmentsAsDoctor()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function conversationsAsPatient()
    {
        return $this->hasMany(Conversation::class, 'patient_id');
    }

    public function conversationsAsDoctor()
    {
        return $this->hasMany(Conversation::class, 'doctor_id');
    }

    public function reviews()       { return $this->hasMany(Review::class, 'doctor_id'); }
    public function blockedDates()  { return $this->hasMany(BlockedDate::class, 'doctor_id'); }
    public function notifications() { return $this->hasMany(Notification::class); }
    
    public function averageRating()
{
    return $this->reviews()->avg('rating') ?? 0;
}
}


