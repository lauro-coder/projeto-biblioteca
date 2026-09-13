<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Livro</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('livros.update', $livro->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="titulo" value="{{ old('titulo', $livro->titulo) }}" class="border w-full p-2">
            </div>

            <div class="mb-3">
                <label>Ano</label>
                <input type="number" name="ano" value="{{ old('ano', $livro->ano) }}" class="border w-full p-2">
            </div>

            <div class="mb-3">
                <label>Autor</label>
                <select name="autor_id" class="border w-full p-2">
                    @foreach ($autores as $autor)
                        <option value="{{ $autor->id }}" @selected($autor->id == $livro->autor_id)>
                            {{ $autor->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar Alterações</button>
        </form>
    </div>
</x-app-layout>