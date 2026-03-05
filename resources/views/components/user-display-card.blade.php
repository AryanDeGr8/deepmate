@props(['user', 'width' => 80])

<div class="p-4 sm:p-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg flex flex-between">
    <div class="flex gap-3">
        <div>
            <img src="{{ $user->pfp }}" alt="{{ $user->name }}'s profile photo" width="{{ $width }}px" class="rounded-full">
        </div>
        <div class="flex flex-col my-auto">
            <div>
                {{$user->name}}
            </div>
            <div class="text-slate-400 mt-1">
                Current Streak - {{ $user->current_streak }} Days
            </div>
        </div>
    </div>

    {{ $slot }}

</div>

