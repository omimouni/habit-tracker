<div class="">
    <div class="">
        <div class="flex items-center justify-center h-screen">
            <div>
                <div class="text-center">
                    <h1 class="text-6xl font-bold font-fancy">Habit Tracker</h1>
                    <p class="text-xl opacity-70">
                        Track your habits and see your progress.
                    </p>
                </div>
                <div class="mt-4">
                    @auth
                    <a href="{{ route('tracker') }}" class="btn btn-block btn-primary">Go to habit tracker</a>
                    @else
                    <a href="{{ route('google.redirect') }}" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700">
                        <img src="https://www.google.com/favicon.ico" alt="Google logo" class="w-5 h-5 mr-2">
                        <span>Continue with Google</span>
                    </a>
                    @endauth
                </div>
            </div>
        </div>

    </div>
</div>