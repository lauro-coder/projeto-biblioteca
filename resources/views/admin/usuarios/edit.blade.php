<x-app-layout>
    <x-slot name="header">
        <x-cabecalho titulo="Alterar nível de acesso" :subtitulo="$usuario->name" :voltar="route('admin.usuarios.index')" />
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.mensagens')

            <x-card>
                <form method="POST" action="{{ route('admin.usuarios.update', $usuario) }}">
                    @csrf
                    @method('PUT')

                    <div class="p-6 sm:p-8 space-y-6">
                        <div class="flex items-center gap-4 rounded-lg bg-slate-50 p-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-700">
                                {{ mb_strtoupper(mb_substr($usuario->name, 0, 1)) }}
                            </span>
                            <div>
                                <p class="font-medium text-slate-900">{{ $usuario->name }}</p>
                                <p class="text-sm text-slate-500">{{ $usuario->email }}</p>
                            </div>
                            <x-badge-role :usuario="$usuario" class="ms-auto" />
                        </div>

                        <fieldset>
                            <legend class="block font-medium text-sm text-slate-700">Nível de acesso</legend>

                            @php
                                $descricoes = [
                                    'admin' => 'Acesso total: cadastra, edita, exclui e gerencia usuários.',
                                    'bibliotecario' => 'Cadastra e edita livros e autores, mas não exclui.',
                                    'usuario' => 'Apenas visualiza livros e autores.',
                                ];
                            @endphp

                            <div class="mt-2 space-y-2">
                                @foreach (App\Models\User::ROLES as $valor => $nome)
                                    <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-slate-200 p-4 hover:bg-slate-50 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                                        <input type="radio" name="role" value="{{ $valor }}" class="mt-0.5 text-indigo-600 focus:ring-indigo-500" @checked(old('role', $usuario->role) == $valor)>
                                        <span>
                                            <span class="block text-sm font-semibold text-slate-900">{{ $nome }}</span>
                                            <span class="block text-sm text-slate-500">{{ $descricoes[$valor] }}</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>

                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </fieldset>
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 px-6 py-4 rounded-b-xl">
                        <x-botao :href="route('admin.usuarios.index')" variante="secundario">Cancelar</x-botao>
                        <x-botao icone="sucesso">Salvar</x-botao>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
