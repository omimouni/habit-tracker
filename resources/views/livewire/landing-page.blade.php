<div class="min-h-screen bg-gradient-to-b from-base-100 to-base-200">
    {{-- Navigation --}}
    <nav class="container px-4 py-5 mx-auto">
        <div class="flex items-center justify-between">
            <div class="text-2xl font-bold font-fancy">
                <span class="text-primary">Habit</span>Tracker
            </div>
            <div class="flex items-center gap-4">
                <button class="btn btn-ghost btn-sm" @click="darkMode.toggleDarkMode()">
                    <i :class="darkMode.isDarkMode ? 'fa-solid fa-sun' : 'fa-solid fa-moon'"></i>
                </button>
                @auth
                <a href="{{ route('tracker') }}" class="btn btn-primary btn-sm">Dashboard</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section with Pattern --}}
    <div class="hero-pattern">
        {{-- Hero Content --}}
        <div class="container relative px-4 mx-auto">
            <div class="flex flex-col items-center justify-center min-h-[80vh] text-center">
                <h1 class="max-w-3xl text-5xl font-bold md:text-7xl font-fancy">
                    Build Better Habits, <span class="text-primary">One Day</span> at a Time
                </h1>
                <p class="max-w-xl mt-6 text-lg opacity-70">
                    Track your daily habits, build streaks, and transform your life with our simple yet powerful habit tracking system.
                </p>
                <div class="flex flex-col gap-4 mt-10 md:flex-row">
                    @auth
                    <a href="{{ route('tracker') }}" class="btn btn-primary btn-lg">
                        Go to Dashboard
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    @else
                    <a href="{{ route('google.redirect') }}" class="btn btn-primary btn-lg">
                        <img src="https://www.google.com/favicon.ico" alt="Google logo" class="w-5 h-5">
                        Continue with Google
                    </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- Decorative Wave --}}
        <svg class="wave-decoration" viewBox="0 0 1440 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,32L48,37.3C96,43,192,53,288,58.7C384,64,480,64,576,58.7C672,53,768,43,864,42.7C960,43,1056,53,1152,53.3C1248,53,1344,43,1392,37.3L1440,32L1440,100L1392,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z"></path>
        </svg>
    </div>

    {{-- Features Section --}}
    <div class="container px-4 py-20 mx-auto">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3 class="mt-4 text-xl font-bold">Daily Tracking</h3>
                <p class="mt-2 opacity-70">Simple and effective way to track your daily habits and build consistency.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 class="mt-4 text-xl font-bold">Visual Progress</h3>
                <p class="mt-2 opacity-70">See your progress over time with beautiful and insightful visualizations.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-fire"></i>
                </div>
                <h3 class="mt-4 text-xl font-bold">Build Streaks</h3>
                <p class="mt-2 opacity-70">Stay motivated by maintaining and growing your habit streaks.</p>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="py-10 border-t border-base-300">
        <div class="container px-4 mx-auto text-center">
            <p class="opacity-70">&copy; {{ date('Y') }} HabitTracker. All rights reserved.</p>
        </div>
    </footer>
</div>

