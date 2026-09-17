@props(['usuario'])

@php
$cores = [
    'admin' => 'bg-purple-50 text-purple-700 ring-purple-600/20',
    'bibliotecario' => 'bg-sky-50 text-sky-700 ring-sky-600/20',
    'usuario' => 'bg-slate-50 text-slate-600 ring-slate-500/20',
];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium ring-1 ring-inset ' . ($cores[$usuario->role] ?? $cores['usuario'])]) }}>
    {{ $usuario->nomeRole() }}
</span>
