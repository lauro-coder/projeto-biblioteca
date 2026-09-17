<x-app-layout>
    <x-slot name="header">
        <x-cabecalho :titulo="$livro->titulo" subtitulo="Detalhes do livro" :voltar="route('livros.index')">
            @can('update', $livro)
                <x-botao :href="route('livros.edit', $livro)" variante="secundario" icone="editar">Editar</x-botao>
            @endcan

            @can('delete', $livro)
                <form action="{{ route('livros.destroy', $livro) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                    @csrf
                    @method('DELETE')
                    <x-botao variante="perigo" icone="excluir">Excluir</x-botao>
                </form>
            @endcan
        </x-cabecalho>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.mensagens')

            <x-card class="p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row gap-8">
                    @include('livros.capa', ['livro' => $livro, 'tamanho' => 'grande'])

                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-slate-900">{{ $livro->titulo }}</h2>
                        <p class="mt-1 text-slate-500">
                            por <a href="{{ route('autores.show', $livro->autor) }}" class="font-medium text-indigo-600 hover:text-indigo-500">{{ $livro->autor->nome }}</a>
                        </p>

                        <dl class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="rounded-lg bg-slate-50 p-4">
                                <dt class="flex items-center gap-1.5 text-xs font-medium uppercase tracking-wide text-slate-500">
                                    <x-icone nome="calendario" class="w-4 h-4" /> Ano de publicação
                                </dt>
                                <dd class="mt-1 text-lg font-semibold text-slate-900">{{ $livro->ano ?? 'Não informado' }}</dd>
                            </div>
                            <div class="rounded-lg bg-slate-50 p-4">
                                <dt class="flex items-center gap-1.5 text-xs font-medium uppercase tracking-wide text-slate-500">
                                    <x-icone nome="globo" class="w-4 h-4" /> Nacionalidade do autor
                                </dt>
                                <dd class="mt-1 text-lg font-semibold text-slate-900">{{ $livro->autor->nacionalidade ?? 'Não informada' }}</dd>
                            </div>
                        </dl>

                        <p class="mt-6 text-xs text-slate-400">Cadastrado em {{ $livro->created_at->format('d/m/Y \à\s H:i') }}</p>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
