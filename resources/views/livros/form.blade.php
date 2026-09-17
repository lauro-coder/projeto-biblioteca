<div class="mb-4">
    <label for="titulo" class="block font-medium">Título</label>
    <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $livro->titulo ?? '') }}" class="border-gray-300 rounded w-full">
    @error('titulo')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="ano" class="block font-medium">Ano</label>
    <input type="number" id="ano" name="ano" value="{{ old('ano', $livro->ano ?? '') }}" class="border-gray-300 rounded w-full">
    @error('ano')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="autor_id" class="block font-medium">Autor</label>
    <select id="autor_id" name="autor_id" class="border-gray-300 rounded w-full">
        <option value="">Selecione...</option>
        @foreach ($autores as $autor)
            <option value="{{ $autor->id }}" @selected($autor->id == old('autor_id', $livro->autor_id ?? null))>{{ $autor->nome }}</option>
        @endforeach
    </select>
    @error('autor_id')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>
