<x-app-layout>
    <x-slot name="header">
        <x-cabecalho :titulo="$autor->nome" subtitulo="Detalhes do autor" :voltar="route('autores.index')">
            @can('update', $autor)
                <x-botao :href="route('autores.edit', $autor)" variante="secundario" icone="editar">Editar</x-botao>
            @endcan

            @can('delete', $autor)
                <form action="{{ route('autores.destroy', $autor) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este autor?')">
                    @csrf
                    @method('DELETE')
                    <x-botao variante="perigo" icone="excluir">Excluir</x-botao>
                </form>
            @endcan
        </x-cabecalho>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @include('partials.mensagens')

            <x-card class="p-6 flex items-center gap-5">
                <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-amber-100 text-2xl font-bold text-amber-700">
                    {{ mb_strtoupper(mb_substr($autor->nome, 0, 1)) }}
                </span>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">{{ $autor->nome }}</h2>
                    <p class="flex items-center gap-1 text-slate-500">
                        <x-icone nome="globo" class="w-4 h-4" />
                        {{ $autor->nacionalidade ?? 'Nacionalidade não informada' }}
                    </p>
                </div>
            </x-card>

            <div>
                <h3 class="mb-3 text-lg font-semibold text-slate-900">
                    Livros deste autor
                    <span class="ms-1 rounded-full bg-slate-200 px-2 py-0.5 text-sm font-medium text-slate-700">{{ $livros->count() }}</span>
                </h3>

                @if ($livros->isEmpty())
                    <x-card>
                        <x-estado-vazio icone="livro" titulo="Nenhum livro cadastrado para este autor" />
                    </x-card>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($livros as $livro)
                            <a href="{{ route('livros.show', $livro) }}" class="block group">
                                <x-card class="flex items-center gap-4 p-4 group-hover:ring-indigo-300 group-hover:shadow-md transition">
                                    @include('livros.capa', ['livro' => $livro, 'tamanho' => 'pequena'])
                                    <div>
                                        <p class="font-medium text-slate-900 group-hover:text-indigo-600">{{ $livro->titulo }}</p>
                                        <p class="text-sm text-slate-500">{{ $livro->ano ?? 'Ano não informado' }}</p>
                                    </div>
                                </x-card>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
