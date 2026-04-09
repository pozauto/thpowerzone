<?php

namespace App\Models;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_routine', 'routine_id', 'student_id');
    }
}
