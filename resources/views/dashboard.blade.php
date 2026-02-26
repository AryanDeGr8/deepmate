
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mt-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-center">
                <div class="p-6 text-3xl font-extrabold text-gray-900 dark:text-gray-100 text-heading text-center">
                    Track Your Daily Working Time
                </div>
                @if(shouldStreakBeIncremented(Auth::user()) || $editDailyTime)
                    <x-daily-time-form :editDailyTime="$editDailyTime"/>
                @else
                <div class="p-6 text-2xl text-gray-900 dark:text-gray-100 text-heading flex justify-center text-center" >
                    @php
                        $time = getTodaysDailyTime(Auth::user())->time;
                    @endphp
                    You worked for {{ intdiv($time,60) }} hours and {{ $time % 60 }} minutes today!
                    <x-nav-link href="{{ route('dashboard', ['editDailyTime' => true ]) }}">Edit</x-nav-link>
                </div>
                @endif
            </div>
            <div class="bg-white mt-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-center">
                <div class="p-6 text-3xl font-extrabold text-gray-900 dark:text-gray-100 text-heading text-center">
                    Streak
                </div>

                <div class="p-6 text-2xl text-gray-900 dark:text-gray-100 text-heading text-center">
                    @if( shouldStreakBeReset(Auth::user()) )
                    @php
                        resetStreak( Auth::user());
                    @endphp
                    @endif
                    You currently have a {{ Auth::user()->current_streak }} day streak!

                </div>


            </div>
            <div class="bg-white mt-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col ">
                <div class="flex justify-center">
                <div class="p-6 text-3xl font-extrabold text-gray-900 dark:text-gray-100 text-heading text-center">
                    Random Quote
                </div>
                </div>
                <x-random-quote :name="$randomQuote->said_by" :quote="$randomQuote->quote" />

            </div>
            <div class="bg-white mt-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-center">
                <div class="p-6 text-3xl font-extrabold text-gray-900 dark:text-gray-100 text-heading text-center">
                    Your Statistics
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
