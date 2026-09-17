<div class="space-y-6">
    <div>
        <x-input-label for="nome" value="Nome" />
        <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome', $autor->nome ?? '')" placeholder="Ex.: Machado de Assis" />
        <x-input-error :messages="$errors->get('nome')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="nacionalidade" value="Nacionalidade" />
        <x-text-input id="nacionalidade" name="nacionalidade" type="text" class="mt-1 block w-full" :value="old('nacionalidade', $autor->nacionalidade ?? '')" placeholder="Ex.: Brasileira" />
        <x-input-error :messages="$errors->get('nacionalidade')" class="mt-2" />
    </div>
</div>
