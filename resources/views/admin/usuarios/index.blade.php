<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gerenciar Usuários</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('partials.mensagens')

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="py-2">Nome</th>
                            <th class="py-2">E-mail</th>
                            <th class="py-2">Nível de acesso</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr class="border-b">
                                <td class="py-2">{{ $usuario->name }}</td>
                                <td class="py-2">{{ $usuario->email }}</td>
                                <td class="py-2">{{ $usuario->nomeRole() }}</td>
                                <td class="py-2 space-x-2">
                                    @if ($usuario->is(auth()->user()))
                                        <span class="text-gray-500">Você</span>
                                    @else
                                        <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="text-blue-600 underline">Alterar acesso</a>

                                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 underline">Excluir</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
