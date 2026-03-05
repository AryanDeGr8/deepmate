<x-app-layout>

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100 px-6 py-10">

    <div class="max-w-7xl mx-auto space-y-8">

        {{-- Page Heading --}}
        <div class="px-8">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight">Blocked Users</h1>
                <p class="text-slate-400 mt-1">Users you have blocked will show up here</p>
            </div>
        </div>

        <div class="py-6">
        <div class="max-w-7xl sm:px-6 lg:px-8 space-y-6 grid sm:p-8 mx-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg">

            @foreach ( $users as $user)

                    <x-user-display-card :user="$user" >
                        <div class="ml-auto my-auto flex gap-3">
                        <form method="post" action="{{ route('friends.destroy', ['friendship' => $friendships[$user->id]]) }}" >
                            @csrf
                            @method('DELETE')
                                <x-primary-button> {{ __('Unblock') }}</x-primary-button>
                        </form>

                        </div>
                    </x-user-display-card>



            @endforeach

        </div>
    </div>

    </div>
</div>

</x-app-layout>
