<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSchedule extends Model
{
    use HasFactory;
    protected $table = 'medical_schedules';
    protected $guarded = ['id'];
    protected $casts = [
        'reminder_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
