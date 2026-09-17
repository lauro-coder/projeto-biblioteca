<div class="space-y-6">
    <div>
        <x-input-label for="titulo" value="Título" />
        <x-text-input id="titulo" name="titulo" type="text" class="mt-1 block w-full" :value="old('titulo', $livro->titulo ?? '')" placeholder="Ex.: Dom Casmurro" />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="sm:col-span-2">
            <x-input-label for="autor_id" value="Autor" />
            <x-select id="autor_id" name="autor_id" class="mt-1 block w-full">
                <option value="">Selecione um autor...</option>
                @foreach ($autores as $autor)
                    <option value="{{ $autor->id }}" @selected($autor->id == old('autor_id', $livro->autor_id ?? null))>{{ $autor->nome }}</option>
                @endforeach
            </x-select>
            <x-input-error :messages="$errors->get('autor_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="ano" value="Ano" />
            <x-text-input id="ano" name="ano" type="number" class="mt-1 block w-full" :value="old('ano', $livro->ano ?? '')" placeholder="Ex.: 1899" />
            <x-input-error :messages="$errors->get('ano')" class="mt-2" />
        </div>
    </div>
</div>
