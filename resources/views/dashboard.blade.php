<x-app-layout>

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100 px-6 py-10">

    <div class="max-w-7xl mx-auto space-y-8">

        {{-- Page Heading --}}
        <div>
            <h1 class="text-3xl font-semibold tracking-tight">Dashboard</h1>
            <p class="text-slate-400 mt-1">Stay consistent. Build momentum.</p>
        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            {{-- TRACKING TIME --}}
            <div class="col-span-1 xl:col-span-2 bg-slate-900/60 backdrop-blur border border-slate-800 rounded-2xl p-6 shadow-xl">
                <h2 class="text-xl font-semibold mb-4">Track Your Daily Working Time</h2>

                <div class="flex items-center justify-between">
                    <div>
                        {{-- staring of the form stuff --}}

                        @if(!Auth::user()->getTodaysDailyTime() || $editDailyTime)
                        <div >
                            <x-daily-time-form :editDailyTime="$editDailyTime"/>
                        </div>
                    @else
                        <p class="text-4xl font-bold">{{ intdiv(Auth::user()->getTodaysDailyTime()->time , 60) }}h {{ Auth::user()->getTodaysDailyTime()->time  % 60 }}m</p>
                        <p class="text-slate-400 mt-1">Logged today</p>
                        <x-nav-link href="{{ route('dashboard', ['editDailyTime' => true ]) }}">Edit</x-nav-link>
                    @endif

{{--
                        <p class="text-4xl font-bold">{{ intdiv(Auth::user()->getTodaysDailyTime()->time , 60) }}h {{ Auth::user()->getTodaysDailyTime()->time  % 60 }}m</p>
                        <p class="text-slate-400 mt-1">Logged today</p> --}}
                    </div>

                    <div class="text-right">
                        <p class="text-sm text-slate-400">Weekly Total</p>
                        <p class="text-lg font-semibold">{{ intdiv(Auth::user()->thisWeeksTime() , 60) }}h {{ Auth::user()->thisWeeksTime()  % 60 }}m</p>

                        <p class="text-sm text-slate-400 mt-3">Monthly Total</p>
                        <p class="text-lg font-semibold">{{ intdiv(Auth::user()->thisMonthsTime() , 60) }}h {{ Auth::user()->thisMonthsTime()  % 60 }}m</p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-4 text-center">
                    <div class="bg-slate-800/60 rounded-xl p-3">
                        <p class="text-sm text-slate-400">Daily Avg</p>
                        <p class="font-semibold">{{ intdiv(Auth::user()->avgTime() , 60) }}h {{ Auth::user()->avgTime()  % 60 }}m</p>
                    </div>

                    <div class="bg-slate-800/60 rounded-xl p-3">
                        <p class="text-sm text-slate-400">Best Day</p>
                        <p class="font-semibold">{{ intdiv(Auth::user()->maxTime() , 60) }}h {{ Auth::user()->maxTime()  % 60 }}m</p>
                    </div>

                    <div class="bg-slate-800/60 rounded-xl p-3">
                        <p class="text-sm text-slate-400">Best Week</p>
                        <p class="font-semibold">{{ intdiv(Auth::user()->bestWeeksTime() , 60) }}h {{ Auth::user()->bestWeeksTime()  % 60 }}m</p>
                    </div>
                </div>
            </div>

            {{-- STREAK --}}
            <div class="bg-slate-900/60 backdrop-blur border border-slate-800 rounded-2xl p-6 shadow-xl text-center">

                @if( shouldStreakBeReset(Auth::user()) )
                    @php
                        resetStreak( Auth::user());
                    @endphp
                @endif
                <h2 class="text-xl font-semibold mb-6">Streak</h2>

                <div class="text-6xl mb-4 flex justify-center">
                    @if (Auth::user()->getTodaysDailyTime())
                        <img class="max-w-[50]" src="{{ Vite::asset('resources/images/orangefire.gif') }}" alt="flame">

                    @else
                        <img class=" max-w-[50]" src="{{ Vite::asset('resources/images/grayfire.gif') }}" alt="flame">

                    @endif

                </div>

                <p class="text-3xl font-bold">{{ Auth::user()->current_streak }} Days</p>
                <p class="text-slate-400 mt-1">Current streak</p>

                <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                    <div class="bg-slate-800/60 rounded-xl p-3">
                        <p class="text-slate-400">Longest</p>
                        <p class="font-semibold">{{ Auth::user()->longest_streak }} Days</p>
                    </div>

                    <div class="bg-slate-800/60 rounded-xl p-3">
                        <p class="text-slate-400">Completion</p>
                        <p class="font-semibold"> {{ round(Auth::user()->current_streak*100/Auth::user()->longest_streak) }}%</p>
                    </div>
                </div>
            </div>

            {{-- QUOTE --}}
            <div class="bg-slate-900/60 backdrop-blur border border-slate-800 rounded-2xl p-8 shadow-xl col-span-1 md:col-span-2">
                <h2 class="text-xl font-semibold mb-6 text-center">Daily Motivation</h2>

                <blockquote class="text-lg italic text-center text-slate-300">
                    “{{ $randomQuote->quote }}”
                </blockquote>

                <p class="text-center text-slate-500 mt-4">— {{ $randomQuote->said_by }}</p>
            </div>

            {{-- STATISTICS --}}
            <div class="bg-slate-900/60 backdrop-blur border border-slate-800 rounded-2xl p-6 shadow-xl">
                <h2 class="text-xl font-semibold mb-6">Your Statistics</h2>

                <div class="space-y-4 text-sm">

                    <div class="flex justify-between">
                        <span class="text-slate-400">Total Lifetime Hours</span>
                        <span class="font-semibold">{{ intdiv( Auth::user()->lifetimeTime(), 60) }}h</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Total Sessions</span>
                        <span class="font-semibold">{{ Auth::user()->daysWorked() }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Average Session</span>
                        <span class="font-semibold">{{ intdiv(Auth::user()->avgTime(), 60) }}h {{ Auth::user()->avgTime()%60 }}m </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">Best Week</span>
                        <span class="font-semibold">{{ intdiv(Auth::user()->bestWeeksTime() , 60) }}h {{ Auth::user()->bestWeeksTime()  % 60 }}m</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-400">This Week vs Last</span>
                        @if(Auth::user()->vsLastWeekPercentage() > 0 && gettype(Auth::user()->vsLastWeekPercentage()) == "string")
                        <span class="font-semibold text-emerald-400">+{{ Auth::user()->vsLastWeekPercentage() }}%</span>
                        @elseif (Auth::user()->vsLastWeekPercentage() > 0 && gettype(Auth::user()->vsLastWeekPercentage()) == "double")
                        <span class="font-semibold text-emerald-400">+{{ round(Auth::user()->vsLastWeekPercentage()) }}%</span>
                        @else
                        <span class="font-semibold text-red-400"> {{ round(Auth::user()->vsLastWeekPercentage()) }}%</span>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</x-app-layout>
