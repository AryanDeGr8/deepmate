<x-app-layout>

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100 px-6 py-10">

    <div class="max-w-7xl mx-auto space-y-8">

        {{-- Page Heading --}}
        <div class="px-8 flex justify-between">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight">Friends</h1>
                <p class="text-slate-400 mt-1">Connect and grow together</p>
            </div>
            <div class="my-auto">
                <form action="{{  route('friends.requests') }}" method="GET">
                    <x-primary-button class="mx-1"> {{ __('Show Friend Requests') }}</x-primary-button>

                </form>
            </div>
        </div>



        <div class="sm:p-8 mx-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg">
            <form method="GET" action="{{ route('friends.add') }}" class="">


                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Search Your Friends') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Type in your friend's email to find them and send them a request! ") }}
                </p>

                <div class="mt-6">
                    <x-input-label for="q" value="q" class="sr-only" />

                    <x-text-input
                        id="q"
                        name="q"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('jean@example.com') }}"
                    />

                </div>

                <div class="mt-6 flex justify-start">
                    <x-primary-button > {{ __('Search') }}</x-primary-button>

                </div>


            </form>


        </div>
        {{-- Main Grid --}}

        <div class="py-6">
        <div class="max-w-7xl sm:px-6 lg:px-8 space-y-6 grid sm:p-8 mx-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('My Friends') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __(" Click on their profile to see what they are up to!") }}
                    </p>
                </div>
            @foreach ( $friends as $friend)

            <x-user-display-card :user="$friend" >
                <div class="ml-auto my-auto flex gap-3">
                    <form method="post" action="{{ route('friends.destroy', ['friendship' => $friendships[$friend->id]]) }}" >
                        @csrf
                        @method('DELETE')
                            <x-primary-button> {{ __('Unfriend') }}</x-primary-button>
                    </form>
                </div>
            </x-user-display-card>

            @endforeach

        </div>
    </div>

    </div>
</div>

</x-app-layout>
