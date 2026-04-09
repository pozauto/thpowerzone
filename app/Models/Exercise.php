<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Routine;
use App\Models\WorkoutLog;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'muscle_group',
        'description',
    ];

    public function routines()
    {
        return $this->belongsToMany(Routine::class);
    }

    public function workoutLogs()
    {
        return $this->hasMany(WorkoutLog::class);
    }
}
