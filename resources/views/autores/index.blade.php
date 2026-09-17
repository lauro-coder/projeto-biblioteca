<x-app-layout>
    <x-slot name="header">
        <x-cabecalho titulo="Autores" subtitulo="{{ $autores->count() }} {{ $autores->count() === 1 ? 'autor cadastrado' : 'autores cadastrados' }}">
            @can('create', App\Models\Autor::class)
                <x-botao :href="route('autores.create')" icone="mais">Novo autor</x-botao>
            @endcan
        </x-cabecalho>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.mensagens')

            @if ($autores->isEmpty())
                <x-card>
                    <x-estado-vazio icone="autor" titulo="Nenhum autor cadastrado">
                        Os autores cadastrados aparecerão aqui.
                    </x-estado-vazio>
                </x-card>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($autores as $autor)
                        <x-card class="flex flex-col p-5 hover:shadow-md transition">
                            <div class="flex items-start gap-4">
                                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-100 text-lg font-bold text-amber-700">
                                    {{ mb_strtoupper(mb_substr($autor->nome, 0, 1)) }}
                                </span>
                                <div class="min-w-0">
                                    <a href="{{ route('autores.show', $autor) }}" class="block truncate font-semibold text-slate-900 hover:text-indigo-600">{{ $autor->nome }}</a>
                                    <p class="flex items-center gap-1 text-sm text-slate-500">
                                        <x-icone nome="globo" class="w-4 h-4" />
                                        {{ $autor->nacionalidade ?? 'Nacionalidade não informada' }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700">
                                    <x-icone nome="livro" class="w-4 h-4" />
                                    {{ $autor->livros_count }} {{ $autor->livros_count === 1 ? 'livro' : 'livros' }}
                                </span>

                                <div class="flex gap-1">
                                    <x-botao :href="route('autores.show', $autor)" variante="fantasma" tamanho="pequeno" icone="ver" title="Ver">
                                        <span class="sr-only">Ver</span>
                                    </x-botao>

                                    @can('update', $autor)
                                        <x-botao :href="route('autores.edit', $autor)" variante="fantasma" tamanho="pequeno" icone="editar" title="Editar">
                                            <span class="sr-only">Editar</span>
                                        </x-botao>
                                    @endcan

                                    @can('delete', $autor)
                                        <form action="{{ route('autores.destroy', $autor) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este autor?')">
                                            @csrf
                                            @method('DELETE')
                                            <x-botao variante="fantasma-perigo" tamanho="pequeno" icone="excluir" title="Excluir">
                                                <span class="sr-only">Excluir</span>
                                            </x-botao>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </x-card>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
