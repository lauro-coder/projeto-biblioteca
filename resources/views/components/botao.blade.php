@props(['href' => null, 'variante' => 'primario', 'icone' => null, 'tamanho' => 'normal'])

@php
$cores = [
    'primario' => 'bg-indigo-600 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600',
    'secundario' => 'bg-white text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50',
    'perigo' => 'bg-red-600 text-white shadow-sm hover:bg-red-500 focus-visible:outline-red-600',
    'fantasma' => 'text-slate-600 hover:bg-slate-100 hover:text-slate-900',
    'fantasma-perigo' => 'text-red-600 hover:bg-red-50 hover:text-red-700',
];

$medidas = $tamanho === 'pequeno' ? 'px-2.5 py-1.5 text-xs gap-1' : 'px-4 py-2 text-sm gap-2';

$classes = 'inline-flex items-center justify-center rounded-lg font-semibold transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 ' . $medidas . ' ' . ($cores[$variante] ?? $cores['primario']);
$tamanhoIcone = $tamanho === 'pequeno' ? 'w-4 h-4' : 'w-5 h-5';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icone)
            <x-icone :nome="$icone" :class="$tamanhoIcone" />
        @endif
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        @if ($icone)
            <x-icone :nome="$icone" :class="$tamanhoIcone" />
        @endif
        {{ $slot }}
    </button>
@endif
