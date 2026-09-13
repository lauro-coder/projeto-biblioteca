<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Livros</h1>

        @if (session('sucesso'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        @if (auth()->user()->isAdmin() || auth()->user()->isBibliotecario())
            <a href="{{ route('livros.create') }}" class="text-blue-600 underline">Cadastrar novo livro</a>
        @endif

        <table class="w-full mt-4 border-collapse">
            <thead>
                <tr class="text-left border-b">
                    <th>Titulo</th>
                    <th>Ano</th>
                    <th>Autor</th>
                    <th>Acoes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livros as $livro)
                    <tr class="border-b">
                        <td>{{ $livro->titulo }}</td>
                        <td>{{ $livro->ano }}</td>
                        <td>{{ $livro->autor->nome }}</td>
                        <td>
                            @if (auth()->user()->isAdmin() || auth()->user()->isBibliotecario())
                                <a href="{{ route('livros.edit', $livro->id) }}" class="text-blue-600 underline">Editar</a>

                                <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza?')">
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
</x-app-layout>