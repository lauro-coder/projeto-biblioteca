<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800">
        <div class="min-h-screen flex flex-col bg-gradient-to-br from-indigo-50 via-white to-amber-50">
            <header class="max-w-6xl w-full mx-auto flex items-center justify-between px-4 sm:px-6 py-6">
                <a href="/" class="flex items-center gap-2">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/30">
                        <x-application-logo class="w-6 h-6" />
                    </span>
                    <span class="text-xl font-bold tracking-tight text-slate-900">Biblioteca</span>
                </a>

                <nav class="flex items-center gap-2">
                    @auth
                        <x-botao :href="route('dashboard')">Acessar o sistema</x-botao>
                    @else
                        <x-botao :href="route('login')" variante="fantasma">Entrar</x-botao>
                        @if (Route::has('register'))
                            <x-botao :href="route('register')">Criar conta</x-botao>
                        @endif
                    @endauth
                </nav>
            </header>

            <main class="flex-1 max-w-6xl w-full mx-auto grid lg:grid-cols-2 gap-12 items-center px-4 sm:px-6 py-12">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">
                        <x-icone nome="livro" class="w-4 h-4" /> Controle de acervo
                    </span>
                    <h1 class="mt-6 text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900">
                        Os livros e autores da biblioteca <span class="text-indigo-600">em um só lugar</span>.
                    </h1>
                    <p class="mt-6 text-lg text-slate-600">
                        Cadastre, consulte e organize o acervo. Cada pessoa tem um nível de acesso: administrador, bibliotecário ou usuário.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        @auth
                            <x-botao :href="route('dashboard')" icone="inicio">Ir para o dashboard</x-botao>
                        @else
                            <x-botao :href="route('login')">Entrar no sistema</x-botao>
                            @if (Route::has('register'))
                                <x-botao :href="route('register')" variante="secundario">Criar uma conta</x-botao>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="hidden lg:flex justify-center">
                    <div class="relative h-80 w-80">
                        <div class="absolute left-4 top-10 h-60 w-44 -rotate-12 rounded-lg bg-gradient-to-br from-amber-400 to-orange-600 shadow-2xl"></div>
                        <div class="absolute right-4 top-6 h-60 w-44 rotate-6 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-700 shadow-2xl"></div>
                        <div class="absolute left-1/2 top-0 flex h-64 w-48 -translate-x-1/2 flex-col justify-between rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-700 p-5 text-white shadow-2xl">
                            <span class="absolute inset-y-0 left-0 w-2 rounded-l-lg bg-black/15"></span>
                            <x-application-logo class="w-10 h-10 text-white/80" />
                            <div>
                                <p class="text-xl font-bold leading-tight">Biblioteca</p>
                                <p class="text-sm text-indigo-100">Livros &amp; Autores</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
