<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 p-6 sm:p-8 text-white shadow-lg shadow-indigo-600/20">
                <x-application-logo class="absolute -right-6 -bottom-10 w-48 h-48 text-white/10" />
                <p class="text-sm font-medium text-indigo-100">{{ now()->format('d/m/Y') }}</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-bold">Olá, {{ auth()->user()->name }}!</h1>
                <p class="mt-2 text-indigo-100">
                    Você está conectado como
                    <span class="rounded-full bg-white/20 px-2 py-0.5 text-sm font-semibold text-white">{{ auth()->user()->nomeRole() }}</span>
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('livros.index') }}" class="group">
                    <x-card class="flex items-center gap-4 p-5 group-hover:shadow-md group-hover:ring-indigo-300 transition">
                        <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <x-icone nome="livro" class="w-6 h-6" />
                        </span>
                        <div>
                            <p class="text-sm text-slate-500">Livros</p>
                            <p class="text-3xl font-bold text-slate-900">{{ $totalLivros }}</p>
                        </div>
                    </x-card>
                </a>
                <a href="{{ route('autores.index') }}" class="group">
                    <x-card class="flex items-center gap-4 p-5 group-hover:shadow-md group-hover:ring-amber-300 transition">
                        <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <x-icone nome="autor" class="w-6 h-6" />
                        </span>
                        <div>
                            <p class="text-sm text-slate-500">Autores</p>
                            <p class="text-3xl font-bold text-slate-900">{{ $totalAutores }}</p>
                        </div>
                    </x-card>
                </a>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.usuarios.index') }}" class="group">
                        <x-card class="flex items-center gap-4 p-5 group-hover:shadow-md group-hover:ring-purple-300 transition">
                            <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                                <x-icone nome="usuarios" class="w-6 h-6" />
                            </span>
                            <div>
                                <p class="text-sm text-slate-500">Usuários</p>
                                <p class="text-3xl font-bold text-slate-900">{{ $totalUsuarios }}</p>
                            </div>
                        </x-card>
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <x-card class="lg:col-span-2">
                    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">
                        <h3 class="font-semibold text-slate-900">Últimos livros cadastrados</h3>
                        <a href="{{ route('livros.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Ver todos</a>
                    </div>

                    @if ($ultimosLivros->isEmpty())
                        <x-estado-vazio icone="livro" titulo="Nenhum livro cadastrado" />
                    @else
                        <ul class="divide-y divide-slate-100">
                            @foreach ($ultimosLivros as $livro)
                                <li>
                                    <a href="{{ route('livros.show', $livro) }}" class="flex items-center gap-4 px-6 py-3 hover:bg-slate-50 transition">
                                        @include('livros.capa', ['livro' => $livro, 'tamanho' => 'pequena'])
                                        <div class="min-w-0 flex-1">
                                            <p class="truncate font-medium text-slate-900">{{ $livro->titulo }}</p>
                                            <p class="truncate text-sm text-slate-500">{{ $livro->autor->nome }}</p>
                                        </div>
                                        <span class="text-sm text-slate-400">{{ $livro->ano }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </x-card>

                <x-card>
                    <div class="border-b border-slate-100 px-6 py-4">
                        <h3 class="font-semibold text-slate-900">O que você pode fazer</h3>
                    </div>
                    <ul class="space-y-3 p-6 text-sm">
                        <li class="flex items-center gap-2 text-slate-700">
                            <x-icone nome="sucesso" class="w-5 h-5 text-emerald-500" /> Visualizar livros e autores
                        </li>
                        @can('create', App\Models\Livro::class)
                            <li class="flex items-center gap-2 text-slate-700">
                                <x-icone nome="sucesso" class="w-5 h-5 text-emerald-500" /> Cadastrar e editar livros e autores
                            </li>
                        @endcan
                        @if (auth()->user()->isAdmin())
                            <li class="flex items-center gap-2 text-slate-700">
                                <x-icone nome="sucesso" class="w-5 h-5 text-emerald-500" /> Excluir livros e autores
                            </li>
                            <li class="flex items-center gap-2 text-slate-700">
                                <x-icone nome="sucesso" class="w-5 h-5 text-emerald-500" /> Gerenciar usuários e níveis de acesso
                            </li>
                        @endif
                    </ul>

                    @can('create', App\Models\Livro::class)
                        <div class="flex flex-wrap gap-2 border-t border-slate-100 px-6 py-4">
                            <x-botao :href="route('livros.create')" tamanho="pequeno" icone="mais">Novo livro</x-botao>
                            <x-botao :href="route('autores.create')" variante="secundario" tamanho="pequeno" icone="mais">Novo autor</x-botao>
                        </div>
                    @endcan
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
