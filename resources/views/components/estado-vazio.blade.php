@props(['icone' => 'livro', 'titulo'])

<div class="text-center py-12 px-6">
    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
        <x-icone :nome="$icone" class="w-6 h-6" />
    </div>
    <h3 class="mt-3 text-sm font-semibold text-slate-900">{{ $titulo }}</h3>
    @if ($slot->isNotEmpty())
        <div class="mt-1 text-sm text-slate-500">{{ $slot }}</div>
    @endif
</div>
