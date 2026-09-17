<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center px-4 py-10 bg-gradient-to-br from-indigo-50 via-white to-amber-50">
            <a href="/" class="flex items-center gap-3">
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/30">
                    <x-application-logo class="w-7 h-7" />
                </span>
                <span class="text-2xl font-bold tracking-tight text-slate-900">Biblioteca</span>
            </a>

            <div class="w-full sm:max-w-md mt-8 px-6 py-8 bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-200 rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
