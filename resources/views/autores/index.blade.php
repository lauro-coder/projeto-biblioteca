<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Autores</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('partials.mensagens')

                @can('create', App\Models\Autor::class)
                    <a href="{{ route('autores.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded mb-4">Cadastrar novo autor</a>
                @endcan

                @if ($autores->isEmpty())
                    <p class="text-gray-600">Nenhum autor cadastrado.</p>
                @else
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="py-2">Nome</th>
                                <th class="py-2">Nacionalidade</th>
                                <th class="py-2">Livros</th>
                                <th class="py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($autores as $autor)
                                <tr class="border-b">
                                    <td class="py-2">{{ $autor->nome }}</td>
                                    <td class="py-2">{{ $autor->nacionalidade ?? '-' }}</td>
                                    <td class="py-2">{{ $autor->livros_count }}</td>
                                    <td class="py-2 space-x-2">
                                        <a href="{{ route('autores.show', $autor) }}" class="text-gray-700 underline">Ver</a>

                                        @can('update', $autor)
                                            <a href="{{ route('autores.edit', $autor) }}" class="text-blue-600 underline">Editar</a>
                                        @endcan

                                        @can('delete', $autor)
                                            <form action="{{ route('autores.destroy', $autor) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este autor?')">
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
