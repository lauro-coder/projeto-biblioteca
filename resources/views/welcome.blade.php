<x-guest-layout>
    <h1 class="text-2xl font-bold text-center mb-2">Biblioteca</h1>
    <p class="text-gray-600 text-center mb-6">Sistema de controle de livros e autores.</p>

    <div class="flex justify-center gap-4">
        @auth
            <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Acessar o sistema</a>
        @else
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Entrar</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="border border-blue-600 text-blue-600 px-4 py-2 rounded">Criar conta</a>
            @endif
        @endauth
    </div>
</x-guest-layout>
