@props(['titulo', 'subtitulo' => null, 'voltar' => null])

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        @if ($voltar)
            <a href="{{ $voltar }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-indigo-600 mb-1">
                <x-icone nome="voltar" class="w-4 h-4" />
                Voltar
            </a>
        @endif
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">{{ $titulo }}</h1>
        @if ($subtitulo)
            <p class="mt-1 text-sm text-slate-500">{{ $subtitulo }}</p>
        @endif
    </div>

    @if ($slot->isNotEmpty())
        <div class="flex flex-wrap items-center gap-2">
            {{ $slot }}
        </div>
    @endif
</div>
