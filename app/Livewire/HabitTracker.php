<?php

namespace App\Livewire;

use App\Models\Habit;
use App\Models\HabitCompletion;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.app')]
class HabitTracker extends Component
{
    public $habits = [];

    #[Url(as: 'tab')]
    public $current_tab = 'calendar';
    
    /**
     * Modal state and form data
     */
    public $showNewHabitModal = false;
    public $editingHabit = null;
    public $habitForm = [
        'name' => '',
        'color' => '#4338ca'
    ];

    public function setTab($tab)
    {
        $this->current_tab = $tab;
    }

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('landing-page');
        }

        $this->habits = auth()->user()->habits()->with('completions')->get();
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

    public function logout()
    {
        auth()->logout();
        return redirect()->route('landing-page');
    }

    /**
     * Opens the edit modal for a specific habit
     */
    public function editHabit($habitId)
    {
        // Find the habit and populate the form
        $this->editingHabit = $this->habits->find($habitId);
        $this->habitForm = [
            'name' => $this->editingHabit->name,
            'color' => $this->editingHabit->color
        ];
        $this->showNewHabitModal = true;
    }

    /**
     * Deletes a habit and its completions
     */
    public function deleteHabit($habitId)
    {
        Habit::destroy($habitId);
        // Refresh habits list
        $this->habits = auth()->user()->habits()->with('completions')->get();
    }

    /**
     * Saves or updates a habit
     */
    public function saveHabit()
    {
        // Validate the form data
        $this->validate([
            'habitForm.name' => 'required|min:3|max:50',
            'habitForm.color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
        ], [
            'habitForm.name.required' => 'Please enter a habit name',
            'habitForm.name.min' => 'Habit name must be at least 3 characters',
            'habitForm.color.required' => 'Please select a color',
        ]);

        if ($this->editingHabit) {
            // Update existing habit
            $this->editingHabit->update([
                'name' => $this->habitForm['name'],
                'color' => $this->habitForm['color'],
            ]);
        } else {
            // Create new habit
            auth()->user()->habits()->create([
                'name' => $this->habitForm['name'],
                'color' => $this->habitForm['color'],
            ]);
        }

        // Reset form and close modal
        $this->habits = auth()->user()->habits()->with('completions')->get();
        $this->showNewHabitModal = false;
        $this->editingHabit = null;
        $this->resetHabitForm();
    }

    /**
     * Resets the habit form to default values
     */
    private function resetHabitForm()
    {
        $this->habitForm = [
            'name' => '',
            'color' => '#4338ca'
        ];
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
