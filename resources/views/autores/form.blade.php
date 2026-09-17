<div class="mb-4">
    <label for="nome" class="block font-medium">Nome</label>
    <input type="text" id="nome" name="nome" value="{{ old('nome', $autor->nome ?? '') }}" class="border-gray-300 rounded w-full">
    @error('nome')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="nacionalidade" class="block font-medium">Nacionalidade</label>
    <input type="text" id="nacionalidade" name="nacionalidade" value="{{ old('nacionalidade', $autor->nacionalidade ?? '') }}" class="border-gray-300 rounded w-full">
    @error('nacionalidade')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>
