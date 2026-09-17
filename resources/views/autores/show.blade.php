<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $autor->nome }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('partials.mensagens')

                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500">Nome</dt>
                        <dd class="text-lg">{{ $autor->nome }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Nacionalidade</dt>
                        <dd class="text-lg">{{ $autor->nacionalidade ?? 'Não informada' }}</dd>
                    </div>
                </dl>

                <h3 class="font-semibold text-lg mt-6 mb-2">Livros deste autor ({{ $livros->count() }})</h3>

                @if ($livros->isEmpty())
                    <p class="text-gray-600">Nenhum livro cadastrado para este autor.</p>
                @else
                    <ul class="list-disc ms-5">
                        @foreach ($livros as $livro)
                            <li>
                                <a href="{{ route('livros.show', $livro) }}" class="text-blue-600 underline">{{ $livro->titulo }}</a>
                                @if ($livro->ano)
                                    ({{ $livro->ano }})
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-6 space-x-2">
                    <a href="{{ route('autores.index') }}" class="text-gray-700 underline">Voltar</a>

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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
