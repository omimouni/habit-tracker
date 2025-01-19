<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabitCompletion extends Model
{
    protected $fillable = ['habit_id', 'completed_at'];

    protected function casts(): array
    {
        return [
            'completed_at' => 'date',
        ];
    }

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }
}
