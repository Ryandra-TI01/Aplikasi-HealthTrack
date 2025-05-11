<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthType extends Model
{
    protected $table = 'health_types';
    protected $guarded = ['id'];
    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class);
    }
}
