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
            <a wire:confirm="Are you sure you want to logout?" wire:click="logout" class="text-sm font-bold cursor-pointer text-error btn btn-ghost btn-xs">
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
                <span class="px-2 pb-1 text-xl font-bold border-b-2 border-dashed md:px-4 md:text-2xl border-primary font-fancy">{{ now()->startOfMonth()->addMonths($selected_month - 1)->monthName  }}</span>
            </div>
            <span>/</span>
            <div>
                <span class="text-lg md:text-xl">Year</span>
                <span class="px-2 pb-1 text-xl font-bold border-b-2 border-dashed md:px-4 md:text-2xl border-primary font-fancy">{{$selected_year}}</span>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <ul class="flex items-center justify-start gap-2">
            <li><a wire:click="setTab('calendar')" class="cursor-pointer block px-3 py-2 rounded-b-none {{ $current_tab === 'calendar' ? 'bg-primary text-white' : 'bg-base-200 hover:bg-base-300' }}">Calendar</a></li>
            <li><a wire:click="setTab('habits')" class="cursor-pointer block px-3 py-2 rounded-b-none {{ $current_tab === 'habits' ? 'bg-primary text-white' : 'bg-base-200 hover:bg-base-300' }}">Habits</a></li>
        </ul>
        <div class="border-t-2 border-primary"></div>
    </div>

    {{-- Habit Tracking Table --}}
    @if ($current_tab === 'calendar')
    <div class="mt-3 md:mt-5">
        <div class="overflow-x-auto bg-base-100" id="habit-tracker"
            x-data
            x-init="setTimeout(() => {
                const today = new Date().getDate();
                const todayCell = document.querySelector(`#habit-${today - 1}`);
                if (todayCell) {
                    todayCell.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                        inline: 'center'
                    });
                }
             }, 200)">

            @if (count($habits) === 0)
            <h4 class="py-4 text-4xl font-bold text-center font-fancy">Create your first habit! </h4>
            @else
            <table class="table table-zebra table-xs md:table-sm">
                {{-- Table Header --}}
                <thead>
                    <tr>
                        <th class="sticky left-0 z-10 bg-base-100">Habits</th>
                        @for ($i = 0; $i < $month_days; $i++)
                            <th class="text-center">
                            <div class="flex flex-col items-center justify-center">
                                <span class="block w-8 md:w-10">{{ now()->startOfMonth()->addDays($i)->format('D') }}</span>
                                <span class="block w-8 font-sans text-xs md:w-10">{{$i + 1}}</span>
                            </div>
                            </th>
                            @endfor
                    </tr>
                </thead>
                {{-- Table Body with Active Habits Only, Sorted by Order --}}
                <tbody>
                    @foreach ($habits->where('is_active', true)->sortBy('order') as $habit)
                    <tr>
                        {{-- Habit Name Cell --}}
                        <td class="sticky left-0 z-10" style="background-color: {{ $habit->color }};">
                            <span class="block w-20 py-1 font-bold md:w-24 md:py-2 font-fancy">{{ $habit->name }}</span>
                        </td>
                        {{-- Habit Checkboxes for Each Day --}}
                        @for ($j = 0; $j < $month_days; $j++)
                            <td class="text-center min-w-12" id="habit-{{ $j }}">
                            <input type="checkbox"
                                wire:click="toggle({{ $habit->id }}, {{ $j }})"
                                {{ $habit->completions->contains('completed_at', now()->startOfMonth()->addDays($j)) ? 'checked' : '' }}
                                {{ $j + 1 < now()->day ? 'disabled="disabled"' : '' }}
                                class="checkbox checkbox-xs checkbox-primary md:checkbox-sm">
                            </td>
                            @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    @endif

    @if ($current_tab === 'habits')
    <div class="mt-3 md:mt-5">
        <div class="bg-base-100 rounded-box">
            {{-- Add New Habit Button --}}
            <div class="flex justify-end p-4">
                <button class="btn btn-primary btn-sm" wire:click="$toggle('showNewHabitModal')">
                    <i class="fa-solid fa-plus"></i> New Habit
                </button>
            </div>

            {{-- Habits List with Drag & Drop --}}
            @if (count($habits) === 0)
            <h4 class="text-4xl font-bold text-center font-fancy">Create your first habit! </h4>
            @else
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Color</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody wire:sortable="updateOrder">
                        @foreach ($habits->sortBy('order') as $habit)
                        <tr wire:sortable.item="{{ $habit->id }}" wire:key="habit-{{ $habit->id }}">
                            {{-- Drag Handle --}}
                            <td wire:sortable.handle class="cursor-move">
                                <i class="opacity-50 fa-solid fa-grip-vertical"></i>
                            </td>

                            {{-- Color Indicator --}}
                            <td>
                                <div class="w-6 h-6 rounded" style="background-color: {{ $habit->color }};"></div>
                            </td>

                            {{-- Habit Name --}}
                            <td class="font-bold {{ !$habit->is_active ? 'opacity-50' : '' }}">
                                {{ $habit->name }}
                            </td>

                            {{-- Active/Inactive Toggle --}}
                            <td>
                                <label class="cursor-pointer label">
                                    <input type="checkbox"
                                        class="toggle toggle-primary toggle-sm"
                                        wire:click="toggleActive({{ $habit->id }})"
                                        {{ $habit->is_active ? 'checked' : '' }}>
                                </label>
                            </td>

                            {{-- Action Buttons --}}
                            <td class="flex gap-2">
                                <button class="btn btn-ghost btn-xs"
                                    wire:click="editHabit({{ $habit->id }})">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-ghost btn-xs text-error"
                                    wire:confirm="Are you sure you want to delete this habit?"
                                    wire:click="deleteHabit({{ $habit->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>
    @endif

    {{-- Habits Management Modal --}}
    <div x-data="{ 
            open: false,
            // Watch Livewire's showNewHabitModal property
            init() {
                this.$watch('$wire.showNewHabitModal', value => {
                    this.open = value;
                });
            }
        }"
        @keydown.escape.window="open = false; $wire.showNewHabitModal = false"
        :class="{ 'modal-open': open }"
        class="modal">

        {{-- Modal Content Box --}}
        <div class="modal-box">
            {{-- Modal Header --}}
            <h3 class="text-lg font-bold">
                {{ $editingHabit ? 'Edit Habit' : 'New Habit' }}
            </h3>

            {{-- Habit Form --}}
            <form wire:submit.prevent="saveHabit">
                {{-- Name Input Field --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Habit Name</span>
                    </label>
                    <input
                        type="text"
                        wire:model.live="habitForm.name"
                        class="input input-bordered"
                        placeholder="Enter habit name"
                        autofocus />
                    @error('habitForm.name')
                    <span class="mt-1 text-sm text-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Color Picker Field --}}
                <div class="mt-4 form-control">
                    <label class="label">
                        <span class="label-text">Color</span>
                    </label>
                    <input
                        type="color"
                        wire:model.live="habitForm.color"
                        class="w-full h-10 rounded cursor-pointer" />
                    @error('habitForm.color')
                    <span class="mt-1 text-sm text-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Modal Action Buttons --}}
                <div class="modal-action">
                    {{-- Cancel Button --}}
                    <button
                        type="button"
                        class="btn"
                        @click="open = false; $wire.showNewHabitModal = false">
                        Cancel
                    </button>
                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="btn btn-primary">
                        {{ $editingHabit ? 'Update' : 'Create' }}
                    </button>
                </div>
            </form>
        </div>

        {{-- Modal Backdrop --}}
        <div
            class="cursor-pointer modal-backdrop"
            @click="open = false; $wire.showNewHabitModal = false"></div>
    </div>
</div>

{{-- JavaScript for Auto-scrolling to Current Day --}}