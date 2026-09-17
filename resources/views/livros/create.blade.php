<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar Livro</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('partials.mensagens')

                <form method="POST" action="{{ route('livros.store') }}">
                    @csrf

                    @include('livros.form')

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
                    <a href="{{ route('livros.index') }}" class="ms-2 text-gray-700 underline">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
