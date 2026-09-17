<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-lg">Olá, <span class="font-semibold">{{ auth()->user()->name }}</span>!</p>
                <p class="text-gray-600">Seu nível de acesso: <span class="font-semibold">{{ auth()->user()->nomeRole() }}</span></p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('livros.index') }}" class="bg-white shadow-sm sm:rounded-lg p-6 block hover:bg-gray-50">
                    <p class="text-sm text-gray-500">Livros</p>
                    <p class="text-3xl font-bold">{{ $totalLivros }}</p>
                </a>
                <a href="{{ route('autores.index') }}" class="bg-white shadow-sm sm:rounded-lg p-6 block hover:bg-gray-50">
                    <p class="text-sm text-gray-500">Autores</p>
                    <p class="text-3xl font-bold">{{ $totalAutores }}</p>
                </a>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.usuarios.index') }}" class="bg-white shadow-sm sm:rounded-lg p-6 block hover:bg-gray-50">
                        <p class="text-sm text-gray-500">Usuários</p>
                        <p class="text-3xl font-bold">{{ $totalUsuarios }}</p>
                    </a>
                @endif
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-2">Últimos livros cadastrados</h3>

                @if ($ultimosLivros->isEmpty())
                    <p class="text-gray-600">Nenhum livro cadastrado.</p>
                @else
                    <ul class="list-disc ms-5">
                        @foreach ($ultimosLivros as $livro)
                            <li>
                                <a href="{{ route('livros.show', $livro) }}" class="text-blue-600 underline">{{ $livro->titulo }}</a>
                                - {{ $livro->autor->nome }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-2">O que você pode fazer</h3>
                <ul class="list-disc ms-5 text-gray-700">
                    <li>Visualizar livros e autores</li>
                    @can('create', App\Models\Livro::class)
                        <li>Cadastrar e editar livros e autores</li>
                    @endcan
                    @if (auth()->user()->isAdmin())
                        <li>Excluir livros e autores</li>
                        <li>Gerenciar usuários e níveis de acesso</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
