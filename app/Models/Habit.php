<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    protected $fillable = [
        'name',
        'color',
        'is_active',
        'order',
        'user_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function completions()
    {
        return $this->hasMany(HabitCompletion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
