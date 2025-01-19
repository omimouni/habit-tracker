<?php

namespace App\Livewire;

use App\Models\Habit;
use App\Models\HabitCompletion;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class HabitTracker extends Component
{
    public $habits = [];

    

    public function mount()
    {
        $this->habits = Habit::with('completions')->get();
    }

    public function toggle($habitId, $day)
    {
        $datetime = now()->startOfMonth()->addDays($day);

        $habit = Habit::find($habitId);
        $completion =$habit->completions()->where('completed_at', $datetime)->first();

        if ($completion) {
            $completion->delete();
        } else {
            $habit->completions()->create([
                'completed_at' => $datetime,
            ]);
        }
    }

    public function render()
    {
        $month_days = now()->daysInMonth();

        // $habits = Habit::with('completions')->get();

        return view('livewire.habit-tracker', [
            'month_days' => $month_days,
        ]);
    }
}
