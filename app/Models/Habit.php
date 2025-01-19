<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    protected $fillable = ['name', 'color', 'user_id'];

    public function completions()
    {
        return $this->hasMany(HabitCompletion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
