<x-app-layout>
    <x-slot name="header">
        <x-cabecalho titulo="Novo livro" subtitulo="Preencha os dados para cadastrar um livro no acervo" :voltar="route('livros.index')" />
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.mensagens')

            <x-card>
                <form method="POST" action="{{ route('livros.store') }}">
                    @csrf

                    <div class="p-6 sm:p-8">
                        @include('livros.form')
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 px-6 py-4 rounded-b-xl">
                        <x-botao :href="route('livros.index')" variante="secundario">Cancelar</x-botao>
                        <x-botao icone="sucesso">Salvar</x-botao>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
