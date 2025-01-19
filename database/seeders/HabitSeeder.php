<?php

namespace Database\Seeders;

use App\Models\Habit;
use App\Models\HabitCompletion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $habits = [
            'Wake up early',
            'Read 10 pages',
            'Exercise',
            'Meditate',
            'Drink water',
            'Meditate',
            'Drink water',
        ];

        $colors = [
            "#9b59b6",
            "#ecf0f1",
            "#e67e22",
            "#f1c40f",
            "#1abc9c"
        ];

        foreach ($habits as $habit) {
            // Create the habit
            $habit = Habit::create(['name' => $habit, 'color' => $colors[array_rand($colors)]]);

            // Add a random completion for the habit
            HabitCompletion::create([
                'habit_id' => $habit->id,
                'completed_at' => now()->subDays(rand(1, 30))->format('Y-m-d'),
            ]);
        }
    }
}
