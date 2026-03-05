<x-app-layout>

    <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100 px-6 py-10">
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- Page Heading --}}
        <div class="px-8">
            <h1 class="text-3xl font-semibold tracking-tight">Profile</h1>
        </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Blocked Users') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Manage the users you have blocked.') }}
                            </p>
                        </header>

                        <form method="get" action="{{ route('profile.blocked') }}" class="mt-6 space-y-6">
                            <div class="mt-6 flex justify-start">
                                <x-primary-button > {{ __('See Blocked Users') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
            <div class="p-4 sm:p-8 bg-slate-900/60 backdrop-blur border border-slate-800 text-slate-100 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
