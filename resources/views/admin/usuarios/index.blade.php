<x-app-layout>
    <x-slot name="header">
        <x-cabecalho titulo="Usuários" subtitulo="Gerencie quem acessa o sistema e o nível de acesso de cada pessoa" />
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.mensagens')

            <x-card class="overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr class="text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                <th class="px-6 py-3">Usuário</th>
                                <th class="px-6 py-3">Nível de acesso</th>
                                <th class="hidden md:table-cell px-6 py-3">Cadastro</th>
                                <th class="px-6 py-3 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($usuarios as $usuario)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">
                                                {{ mb_strtoupper(mb_substr($usuario->name, 0, 1)) }}
                                            </span>
                                            <div>
                                                <p class="font-medium text-slate-900">{{ $usuario->name }}</p>
                                                <p class="text-sm text-slate-500">{{ $usuario->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4"><x-badge-role :usuario="$usuario" /></td>
                                    <td class="hidden md:table-cell px-6 py-4 text-sm text-slate-500">{{ $usuario->created_at?->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-1">
                                            @if ($usuario->is(auth()->user()))
                                                <span class="px-2.5 py-1.5 text-xs font-medium text-slate-400">Você</span>
                                            @else
                                                <x-botao :href="route('admin.usuarios.edit', $usuario)" variante="fantasma" tamanho="pequeno" icone="escudo" title="Alterar acesso"><span class="hidden lg:inline">Alterar acesso</span></x-botao>

                                                <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-botao variante="fantasma-perigo" tamanho="pequeno" icone="excluir" title="Excluir"><span class="hidden lg:inline">Excluir</span></x-botao>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
