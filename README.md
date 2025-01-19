### Habit Tracker

A simple habit tracker built with Laravel and Livewire.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/habit-tracker.git
   cd habit-tracker
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node dependencies:
   ```bash
   npm install
   ```

4. Set up environment:
   ```bash
   cp .env.example .env
   # Configure your database settings in .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run database migrations:
   ```bash
   php artisan migrate
   ```

7. Start development servers:
   ```bash
   # In first terminal:
   npm run dev

   # In second terminal:
   php artisan serve
   ```

Your application should now be running at http://localhost:8000

## Features

- [x] Create and manage habits
- [x] Track daily habit completions
- [ ] View habit streaks and progress statistics
- [ ] User authentication and profiles
- [ ] Responsive mobile design
- [ ] Dark/Light theme toggle
- [ ] Organize habits into categories

