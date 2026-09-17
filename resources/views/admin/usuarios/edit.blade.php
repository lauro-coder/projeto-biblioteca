<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Alterar nível de acesso</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('partials.mensagens')

                <p class="mb-4">
                    <span class="font-semibold">{{ $usuario->name }}</span>
                    ({{ $usuario->email }})
                </p>

                <form method="POST" action="{{ route('admin.usuarios.update', $usuario) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="role" class="block font-medium">Nível de acesso</label>
                        <select id="role" name="role" class="border-gray-300 rounded w-full">
                            @foreach (App\Models\User::ROLES as $valor => $nome)
                                <option value="{{ $valor }}" @selected(old('role', $usuario->role) == $valor)>{{ $nome }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
                    <a href="{{ route('admin.usuarios.index') }}" class="ms-2 text-gray-700 underline">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
