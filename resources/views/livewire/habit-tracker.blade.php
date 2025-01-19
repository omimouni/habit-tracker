<div class="w-full px-2 m-auto md:w-2/3 md:px-0">
    {{-- Navigation Bar --}}
    <div class="flex items-center justify-end py-3 md:py-5">
        <div class="flex items-center gap-1">
            {{-- Home Button --}}
            <a href="{{ route('landing-page') }}" class="cursor-pointer text btn btn-ghost btn-xs">
                <i class="fa-solid fa-house"></i>
            </a>

            {{-- Dark Mode Toggle --}}
            <a class="btn btn-ghost btn-xs" @click="darkMode.toggleDarkMode()">
                <i :class="darkMode.isDarkMode ? 'fa-solid fa-sun' : 'fa-solid fa-moon'"></i>
            </a>

            {{-- Logout Button --}}
            <a wire:confirm="Are you sure you want to logout?" wire:click="logout" class="text-sm text-lg font-bold cursor-pointer text-error btn btn-ghost btn-xs">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>
    </div>

    {{-- Header Section with Title and Date - Make it stack on mobile --}}
    <div class="flex flex-col items-center justify-between gap-4 py-3 md:flex-row md:py-5 md:gap-0">
        {{-- Title --}}
        <h2 class="text-3xl md:text-5xl">
            <span>Habit</span>
            <span class="font-bold font-fancy">Tracker</span>
        </h2>
        {{-- Month/Year Display --}}
        <div class="flex items-center gap-3 text-sm md:gap-5 md:text-base">
            <div>
                <span class="text-lg md:text-xl">Month</span>
                <span class="px-2 pb-1 text-xl font-bold border-b-2 border-dashed md:px-4 md:text-2xl border-primary font-fancy">January</span>
            </div>
            <span>/</span>
            <div>
                <span class="text-lg md:text-xl">Year</span>
                <span class="px-2 pb-1 text-xl font-bold border-b-2 border-dashed md:px-4 md:text-2xl border-primary font-fancy">2025</span>
            </div>
        </div>
    </div>

    <div class="border-t-2 border-dashed border-primary"></div>

    {{-- Habit Tracking Table --}}
    <div class="mt-3 md:mt-5">
        <div class="overflow-x-auto bg-base-100" id="habit-tracker">
            <table class="table table-zebra table-xs md:table-sm">
                {{-- Table Header with Days --}}
                <thead>
                    <tr class="text-base md:text-lg font-fancy">
                        <th class="sticky left-0 z-20 text-center bg-base-100">Habit</th>
                        @for ($i = 0; $i < $month_days; $i++)
                            <th class="text-center min-w-12">
                            {{-- Day Header with Name and Number --}}
                            <div class="flex flex-col items-center justify-center {{ $i + 1 < now()->day ? 'text-gray-300' : '' }}">
                                <span class="block w-8 md:w-10">{{ now()->startOfMonth()->addDays($i)->format('D') }}</span>
                                <span class="block w-8 font-sans text-xs md:w-10">{{$i + 1}}</span>
                            </div>
                            </th>
                        @endfor
                    </tr>
                </thead>
                {{-- Table Body with Habits --}}
                <tbody>
                    @foreach ($habits as $habit)
                    <tr>
                        {{-- Habit Name Cell - Make it sticky and ensure it stays visible --}}
                        <td class="sticky left-0 z-10 text-base md:text-lg" style="background-color: {{ $habit->color }};">
                            <span class="block w-20 py-1 font-bold md:w-24 md:py-2 font-fancy">{{ $habit->name }}</span>
                        </td>
                        {{-- Habit Checkboxes for Each Day --}}
                        @for ($j = 0; $j < $month_days; $j++)
                            <td class="text-center min-w-12" id="habit-{{ $j }}">
                            <input type="checkbox"
                                wire:click="toggle({{ $habit->id }}, {{ $j }})"
                                {{ $habit->completions->contains('completed_at', now()->startOfMonth()->addDays($j)) ? 'checked' : '' }}
                                {{ $j + 1 < now()->day ? 'disabled="disabled"' : '' }}
                                class="checkbox checkbox-xs md:checkbox-sm">
                            </td>
                        @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- JavaScript for Auto-scrolling to Current Day --}}
@script
<script>
    // Get the habit tracker container
    container = document.getElementById('habit-tracker');

    // Scroll to today's column (positioned at start of view)
    today_row = container.querySelector(`#habit-${new Date().getDate()}`);
    today_row.scrollIntoView({
        behavior: 'smooth',
        block: 'start',
        inline: 'center'
    });
</script>
@endscript