<x-app-layout>

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100 px-6 py-10">

    <div class="max-w-7xl mx-auto space-y-8">

        {{-- Page Heading --}}
        <div class="px-8 flex justify-between">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight">Add Friends</h1>
                <p class="text-slate-400 mt-1">Connect and grow together</p>
            </div>
            <div class="my-auto">
                <form action="{{  route('friends') }}" method="GET">
                    <x-primary-button class="mx-1"> {{ __('Show Friends') }}</x-primary-button>

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
                        required
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
                        {{ __('Search Results') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Add Your Friends!") }}
                    </p>
                </div>
            @foreach ( $friendships as $user_id => $friendship)
                <x-user-display-card :user="$users[$user_id]" >
                    <div class="ml-auto my-auto flex gap-3">

                        @if ( $friendship['status'] == 'friends')
                            <form method="post" action="{{ route('friends.destroy', ['friendship' => $friendship['friendship']]) }}" >
                                @csrf
                                @method('DELETE')
                                    <x-primary-button> {{ __('Unfriend') }}</x-primary-button>
                            </form>
                        @elseif ( $friendship['status'] == 'sent')
                            <form method="post" action="{{ route('friends.destroy', ['friendship' => $friendship['friendship']]) }}" >
                                @csrf
                                @method('DELETE')
                                    <x-primary-button> {{ __('Cancel') }}</x-primary-button>
                            </form>
                        @elseif ( $friendship['status'] == 'received')
                            <form method="post" action="{{ route('friends.update', ['friendship' => $friendship['friendship']]) }}" >
                                @csrf
                                @method('PATCH')

                                    <x-primary-button> {{ __('Accept') }}</x-primary-button>
                            </form>


                            <form method="post" action="{{ route('friends.destroy', ['friendship' => $friendship['friendship']]) }}" >
                                @csrf
                                @method('DELETE')
                                    <x-danger-button> {{ __('Reject') }}</x-danger-button>
                            </form>
                        @else
                            <form method="post" action="{{ route('friends.store') }}" >
                                @csrf
                                @method('POST')
                                <x-text-input
                                    id="user_id"
                                    name="user_id"
                                    :value="$user_id"
                                    type="number"
                                    hidden
                                />
                                <x-text-input
                                    id="action"
                                    name="action"
                                    value="add"
                                    type="text"
                                    hidden
                                />
                                <x-primary-button > {{ __('Add Friend') }}</x-primary-button>
                            </form>


                            <form method="post" action="{{ route('friends.store') }}" >
                                @csrf
                                @method('POST')
                                <x-text-input
                                    id="user_id"
                                    name="user_id"
                                    :value="$user_id"
                                    type="number"
                                    hidden
                                />
                                <x-text-input
                                    id="action"
                                    name="action"
                                    value="block"
                                    type="text"
                                    hidden
                                />
                                    <x-danger-button > {{ __('Block') }}</x-danger-button>
                            </form>

                        @endif


                    </div>
                </x-user-display-card>


            @endforeach

        </div>
    </div>

    </div>
</div>

</x-app-layout>
