<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['doctor_id', 'date', 'reason'])]
class BlockedDate extends Model
{
    public function doctor() { return $this->belongsTo(User::class, 'doctor_id'); }
}