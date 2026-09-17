<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $livro->titulo }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('partials.mensagens')

                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500">Título</dt>
                        <dd class="text-lg">{{ $livro->titulo }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Ano de publicação</dt>
                        <dd class="text-lg">{{ $livro->ano ?? 'Não informado' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Autor</dt>
                        <dd class="text-lg">{{ $livro->autor->nome }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Cadastrado em</dt>
                        <dd>{{ $livro->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>

                <div class="mt-6 space-x-2">
                    <a href="{{ route('livros.index') }}" class="text-gray-700 underline">Voltar</a>

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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
