<div class="min-h-screen bg-base-100">
    <div class="container px-4 mx-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-md p-8 bg-base-200 rounded-2xl">
                <div class="space-y-4 text-center">
                    <h1 class="text-6xl font-bold text-transparent font-fancy bg-gradient-to-r from-primary to-secondary bg-clip-text">
                        Habit Tracker
                    </h1>
                    <p class="text-xl text-base-content/80">
                        Track your habits and see your progress.
                    </p>
                </div>
                <div class="mt-8">
                    @auth
                        <a href="{{ route('tracker') }}" 
                           class="block w-full px-6 py-3 text-lg font-semibold text-center transition-opacity duration-200 rounded-lg text-base-100 bg-gradient-to-r from-primary to-secondary hover:opacity-90">
                            Go to habit tracker
                        </a>
                    @else
                        <a href="{{ route('google.redirect') }}" 
                           class="flex items-center justify-center w-full px-6 py-3 transition-colors duration-200 border-2 rounded-lg text-base-content border-base-300 hover:bg-base-300">
                            <img src="https://www.google.com/favicon.ico" alt="Google logo" class="w-5 h-5 mr-3">
                            <span class="text-lg font-medium">Continue with Google</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>