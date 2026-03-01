
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body>

    <div class="grid grid-cols-2 gap-6 m-6">
        <div class="bg-red-500 min-h-[50px]"></div>
        <div class="bg-red-500 min-h-[50px]"></div>
        <div class="bg-red-500 min-h-[50px]"></div>
        <div class="bg-red-500 min-h-[50px]"></div>
        <div class="bg-red-500 min-h-[50px]"></div>
        <div class="bg-red-500 min-h-[50px]"></div>
    </div>

</body>
</html>
