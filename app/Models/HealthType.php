<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthType extends Model
{
     use HasFactory;
    protected $table = 'health_types';
    protected $guarded = ['id'];
    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class);
    }
}
