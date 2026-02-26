
@if(!$editDailyTime || !getTodaysDailyTime(Auth::user()))
<form method="POST" action="{{ route('dailytime.store' ) }}">
    @csrf

    <!-- Hours -->
    <div class="flex justify-center items-center p-4 gap-6">
            <div class="flex gap-6">
            <div>
                <x-input-label for="hours" :value="__('Hours')" />
                <x-text-input id="hours" class="block mt-1" type="number" name="hours" min="0" max="23" required autofocus />
                <x-input-error :messages="$errors->get('hours')" class="mt-2" />
            </div>

            <!-- Minutes -->
            <div>
                <x-input-label for="minutes" :value="__('Minutes')" />

                <x-text-input id="minutes" class="block mt-1"
                                type="number"
                                name="minutes"
                                min="0"
                                max="59"
                                required />

                <x-input-error :messages="$errors->get('minutes')" class="mt-2" />
            </div>
        </div>
        <div>

            <x-primary-button class="ms-3">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </div>
</form>
@else
<form method="POST" action="{{ route('dailytime.update' ) }}">
    @csrf
    @method('PUT')
    <!-- Hours -->
    <div class="flex justify-center items-center p-4 gap-6">
            <div class="flex gap-6">
            <div>
                <x-input-label for="hours" :value="__('Hours')" />
                <x-text-input id="hours" class="block mt-1" type="number" name="hours" min="0" max="23" required autofocus />
                <x-input-error :messages="$errors->get('hours')" class="mt-2" />
            </div>

            <!-- Minutes -->
            <div>
                <x-input-label for="minutes" :value="__('Minutes')" />

                <x-text-input id="minutes" class="block mt-1"
                                type="number"
                                name="minutes"
                                min="0"
                                max="59"
                                required />

                <x-input-error :messages="$errors->get('minutes')" class="mt-2" />
            </div>
        </div>
        <div>

            <x-primary-button class="ms-3">
                {{ __('Edit') }}
            </x-primary-button>
        </div>
    </div>
</form>

@endif
