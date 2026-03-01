<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-slate-100">

    {{-- NAVBAR --}}
    <header class="border-b border-slate-800 bg-slate-950/70 backdrop-blur">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold tracking-tight">
                {{ config('app.name') }}
            </h1>

            <div class="space-x-4">
                <a href="{{ route('login') }}"
                   class="text-slate-300 hover:text-white transition">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="bg-indigo-600 hover:bg-indigo-500 px-4 py-2 rounded-xl font-medium transition">
                    Get Started
                </a>
            </div>
        </div>
    </header>

    {{-- HERO --}}
    <section class="py-24 px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-5xl font-bold leading-tight tracking-tight">
                Build Discipline.<br>
                Track What Matters.
            </h2>

            <p class="mt-6 text-lg text-slate-400 max-w-2xl mx-auto">
                A minimal productivity dashboard that helps you track daily working time,
                build powerful streaks, and stay consistent every single day.
            </p>

            <div class="mt-10 flex justify-center gap-4">
                <a href="{{ route('register') }}"
                   class="bg-indigo-600 hover:bg-indigo-500 px-6 py-3 rounded-2xl text-lg font-semibold shadow-lg transition">
                    Start Free
                </a>

                <a href="{{ route('login') }}"
                   class="border border-slate-700 hover:border-slate-500 px-6 py-3 rounded-2xl text-lg transition">
                    Login
                </a>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section class="py-20 px-6 border-t border-slate-800">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8">

            <div class="bg-slate-900/60 backdrop-blur border border-slate-800 rounded-2xl p-8">
                <div class="text-4xl mb-4">⏱️</div>
                <h3 class="text-xl font-semibold mb-3">Track Your Time</h3>
                <p class="text-slate-400">
                    Log your daily work hours and gain insight into your productivity
                    patterns across weeks and months.
                </p>
            </div>

            <div class="bg-slate-900/60 backdrop-blur border border-slate-800 rounded-2xl p-8">
                <div class="text-4xl mb-4">🔥</div>
                <h3 class="text-xl font-semibold mb-3">Build Streaks</h3>
                <p class="text-slate-400">
                    Stay consistent with powerful streak tracking that motivates
                    you to never miss a productive day.
                </p>
            </div>

            <div class="bg-slate-900/60 backdrop-blur border border-slate-800 rounded-2xl p-8">
                <div class="text-4xl mb-4">📊</div>
                <h3 class="text-xl font-semibold mb-3">Meaningful Analytics</h3>
                <p class="text-slate-400">
                    View lifetime hours, weekly improvements, average sessions,
                    and completion rates in a clean dashboard.
                </p>
            </div>

        </div>
    </section>

    {{-- SOCIAL PROOF / STATS --}}
    <section class="py-20 px-6 border-t border-slate-800">
        <div class="max-w-5xl mx-auto text-center">
            <h3 class="text-3xl font-semibold mb-12">
                Designed for Long-Term Focus
            </h3>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-4xl font-bold">100%</p>
                    <p class="text-slate-400 mt-2">Private Data</p>
                </div>

                <div>
                    <p class="text-4xl font-bold">∞</p>
                    <p class="text-slate-400 mt-2">Streak Potential</p>
                </div>

                <div>
                    <p class="text-4xl font-bold">0</p>
                    <p class="text-slate-400 mt-2">Distractions</p>
                </div>

                <div>
                    <p class="text-4xl font-bold">1</p>
                    <p class="text-slate-400 mt-2">Goal: Consistency</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FINAL CTA --}}
    <section class="py-24 px-6 border-t border-slate-800 text-center">
        <div class="max-w-3xl mx-auto">
            <h3 class="text-4xl font-bold">
                Start Building Your Momentum Today
            </h3>

            <p class="mt-6 text-slate-400">
                Discipline compounds. Your streak starts now.
            </p>

            <div class="mt-10">
                <a href="{{ route('register') }}"
                   class="bg-indigo-600 hover:bg-indigo-500 px-8 py-4 rounded-2xl text-lg font-semibold shadow-xl transition">
                    Create Free Account
                </a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="border-t border-slate-800 py-8 px-6 text-center text-slate-500 text-sm">
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>

</body>
</html>
