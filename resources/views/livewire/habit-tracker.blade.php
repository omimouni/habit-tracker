<div class="w-2/3 m-auto">
    <div class="flex items-center justify-end py-5">
        <div class="flex items-center gap-1">
            <a href="{{ route('landing-page') }}" class="cursor-pointer text btn btn-ghost btn-xs">
                <i class="fa-solid fa-house"></i>
            </a>

            <a class="btn btn-ghost btn-xs" @click="darkMode.toggleDarkMode()">
                <i :class="darkMode.isDarkMode ? 'fa-solid fa-sun' : 'fa-solid fa-moon'"></i>
            </a>

            <a wire:confirm="Are you sure you want to logout?" wire:click="logout" class="text-sm text-lg font-bold cursor-pointer text-error btn btn-ghost btn-xs">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>
    </div>
    <div class="flex items-center justify-between py-5">
        <h2 class="text-5xl">
            <span>Habit</span>
            <span class="font-bold font-fancy">Tracker</span>
        </h2>
        <div class="flex items-center gap-5">
            <div>
                <span class="text-xl">Month</span>
                <span class="px-4 pb-1 text-2xl font-bold border-b-2 border-dashed border-primary font-fancy">January</span>
            </div>
            <span>/</span>
            <div>
                <span class="text-xl">Year</span>
                <span class="px-4 pb-1 text-2xl font-bold border-b-2 border-dashed border-primary font-fancy">2025</span>
            </div>
        </div>
    </div>

    <div class="border-t-2 border-dashed border-primary"></div>

    <div class="mt-5">
        <div class="overflow-auto bg-base-100" id="habit-tracker">
            <table class="table table-zebra table-xs">
                <thead>
                    <tr class="text-lg font-fancy">
                        <th class="text-center">Habit</th>
                        @for ($i = 0; $i < $month_days; $i++)
                            <th class="text-center">

                            <div class="flex flex-col items-center justify-center {{ $i + 1 < now()->day ? 'text-gray-300' : '' }}">
                                <span class="block w-10">{{ now()->startOfMonth()->addDays($i)->format('D') }}</span>
                                <span class="block w-10 font-sans text-xs">{{$i + 1}}</span>
                            </div>
                            </th>
                            @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($habits as $habit)
                    <tr>
                        <!-- TODO: background to be habit specific -->
                        <td class="sticky left-0 z-10 text-lg " style="background-color: {{ $habit->color }};">
                            <span class="block w-24 py-2 font-bold font-fancy">{{ $habit->name }}</span>
                        </td>
                        @for ($j = 0; $j < $month_days; $j++)
                            <td class="text-center" id="habit-{{ $j }}">
                            <input type="checkbox"
                                wire:click="toggle({{ $habit->id }}, {{ $j }})"
                                {{ $habit->completions->contains('completed_at', now()->startOfMonth()->addDays($j)) ? 'checked' : '' }}
                                {{ $j + 1 < now()->day ? 'disabled="disabled"' : '' }}
                                class="checkbox checkbox-xs">
                            </td>
                            @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@script
<script>
    container = document.getElementById('habit-tracker');

    // Scroll to today 
    today_row = container.querySelector(`#habit-${new Date().getDate() + 10}`);
    today_row.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
    });
</script>
@endscript