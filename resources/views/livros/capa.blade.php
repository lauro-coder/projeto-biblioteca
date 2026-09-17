@php
    // cor da "capa" escolhida pelo id do livro
    $cores = ['from-indigo-500 to-indigo-700', 'from-amber-400 to-orange-600', 'from-emerald-500 to-teal-700', 'from-rose-500 to-pink-700', 'from-sky-500 to-blue-700', 'from-violet-500 to-purple-700'];
    $cor = $cores[$livro->id % count($cores)];
    $medidas = ($tamanho ?? 'pequena') === 'grande' ? 'w-28 h-40 text-4xl rounded-lg' : 'w-9 h-12 text-sm rounded';
@endphp

<span class="relative flex shrink-0 items-center justify-center bg-gradient-to-br {{ $cor }} {{ $medidas }} font-bold text-white shadow-md">
    <span class="absolute inset-y-0 left-0 w-1 bg-black/15"></span>
    {{ mb_strtoupper(mb_substr($livro->titulo, 0, 1)) }}
</span>
