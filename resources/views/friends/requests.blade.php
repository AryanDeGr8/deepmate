<x-app-layout>

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100 px-6 py-10">

    <div class="max-w-7xl mx-auto space-y-8">

        {{-- Page Heading --}}
        <div class="px-8 flex justify-between">
            <div>
                <h1 class="text-3xl font-semibold tracking-tight">Friend Requests</h1>
                <p class="text-slate-400 mt-1">Your sent and received requests will show up here</p>
            </div>
            <div class="my-auto">

                <form action="{{  route('friends') }}" method="GET">
                    <x-primary-button class="mx-1"> {{ __('Show Friends') }}</x-primary-button>

                </form>

            </div>
        </div>



        <div class="py-6">
            <div class="max-w-7xl sm:px-6 lg:px-8 space-y-6 grid sm:p-8 mx-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Received Requests') }}
                        </h2>

                    </div>
                @foreach ( $receivedRequests as $receivedRequest)

                <x-user-display-card :user="$receivedRequest" >
                    <div class="ml-auto my-auto flex gap-3">
                        <form method="post" action="{{ route('friends.update', ['friendship' => $receivedRequestFriendships[$receivedRequest->id]]) }}" >
                            @csrf
                            @method('PATCH')
                                <x-primary-button> {{ __('Accept') }}</x-primary-button>
                        </form>


                        <form method="post" action="{{ route('friends.destroy', ['friendship' => $receivedRequestFriendships[$receivedRequest->id]]) }}" >
                            @csrf
                            @method('DELETE')
                                <x-danger-button> {{ __('Reject') }}</x-danger-button>
                        </form>
                    </div>
                </x-user-display-card>

                @endforeach

            </div>
        </div>

        <div class="py-6">
        <div class="max-w-7xl sm:px-6 lg:px-8 space-y-6 grid sm:p-8 mx-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Sent Requests') }}
                    </h2>

                </div>
            @foreach ( $sentRequests as $sentRequest)
            <x-user-display-card :user="$sentRequest" >
                <div class="ml-auto my-auto flex gap-3">
                    <form method="post" action="{{ route('friends.destroy', ['friendship' => $sentRequestFriendships[$sentRequest->id]]) }}" >
                        @csrf
                        @method('DELETE')
                            <x-primary-button> {{ __('Cancel') }}</x-primary-button>
                    </form>

                </div>
            </x-user-display-card>
            @endforeach

        </div>
    </div>

    </div>
</div>

</x-app-layout>
