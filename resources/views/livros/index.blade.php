<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Livros</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('partials.mensagens')

                @can('create', App\Models\Livro::class)
                    <a href="{{ route('livros.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded mb-4">Cadastrar novo livro</a>
                @endcan

                @if ($livros->isEmpty())
                    <p class="text-gray-600">Nenhum livro cadastrado.</p>
                @else
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="py-2">Título</th>
                                <th class="py-2">Ano</th>
                                <th class="py-2">Autor</th>
                                <th class="py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livros as $livro)
                                <tr class="border-b">
                                    <td class="py-2">{{ $livro->titulo }}</td>
                                    <td class="py-2">{{ $livro->ano ?? '-' }}</td>
                                    <td class="py-2">{{ $livro->autor->nome }}</td>
                                    <td class="py-2 space-x-2">
                                        <a href="{{ route('livros.show', $livro) }}" class="text-gray-700 underline">Ver</a>

                                        @can('update', $livro)
                                            <a href="{{ route('livros.edit', $livro) }}" class="text-blue-600 underline">Editar</a>
                                        @endcan

                                        @can('delete', $livro)
                                            <form action="{{ route('livros.destroy', $livro) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 underline">Excluir</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
