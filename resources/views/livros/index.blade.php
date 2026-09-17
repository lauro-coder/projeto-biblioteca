<x-app-layout>
    <x-slot name="header">
        <x-cabecalho titulo="Livros" subtitulo="{{ $livros->count() }} {{ $livros->count() === 1 ? 'livro cadastrado' : 'livros cadastrados' }} no acervo">
            @can('create', App\Models\Livro::class)
                <x-botao :href="route('livros.create')" icone="mais">Novo livro</x-botao>
            @endcan
        </x-cabecalho>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.mensagens')

            <x-card class="overflow-hidden">
                @if ($livros->isEmpty())
                    <x-estado-vazio icone="livro" titulo="Nenhum livro cadastrado">
                        Os livros cadastrados aparecerão aqui.
                    </x-estado-vazio>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr class="text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    <th class="px-6 py-3">Título</th>
                                    <th class="hidden sm:table-cell px-6 py-3">Autor</th>
                                    <th class="hidden md:table-cell px-6 py-3">Ano</th>
                                    <th class="px-6 py-3 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($livros as $livro)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4">
                                            <a href="{{ route('livros.show', $livro) }}" class="flex items-center gap-3 group">
                                                @include('livros.capa', ['livro' => $livro, 'tamanho' => 'pequena'])
                                                <span>
                                                    <span class="block font-medium text-slate-900 group-hover:text-indigo-600">{{ $livro->titulo }}</span>
                                                    <span class="block text-sm text-slate-500 sm:hidden">{{ $livro->autor->nome }}</span>
                                                </span>
                                            </a>
                                        </td>
                                        <td class="hidden sm:table-cell px-6 py-4 text-sm">
                                            <a href="{{ route('autores.show', $livro->autor) }}" class="text-slate-600 hover:text-indigo-600">{{ $livro->autor->nome }}</a>
                                        </td>
                                        <td class="hidden md:table-cell px-6 py-4 text-sm text-slate-500">{{ $livro->ano ?? '—' }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-1">
                                                <x-botao :href="route('livros.show', $livro)" variante="fantasma" tamanho="pequeno" icone="ver" title="Ver"><span class="hidden lg:inline">Ver</span></x-botao>

                                                @can('update', $livro)
                                                    <x-botao :href="route('livros.edit', $livro)" variante="fantasma" tamanho="pequeno" icone="editar" title="Editar"><span class="hidden lg:inline">Editar</span></x-botao>
                                                @endcan

                                                @can('delete', $livro)
                                                    <form action="{{ route('livros.destroy', $livro) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-botao variante="fantasma-perigo" tamanho="pequeno" icone="excluir" title="Excluir"><span class="hidden lg:inline">Excluir</span></x-botao>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>
