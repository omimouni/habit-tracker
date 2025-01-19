<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    protected $fillable = ['name', 'color'];

    public function completions()
    {
        return $this->hasMany(HabitCompletion::class);
    }
}
