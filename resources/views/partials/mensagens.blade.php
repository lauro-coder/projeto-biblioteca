@if (session('sucesso'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('sucesso') }}
    </div>
@endif

@if (session('erro'))
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        {{ session('erro') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <p class="font-semibold">Verifique os erros abaixo:</p>
        <ul class="list-disc ms-5">
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif
