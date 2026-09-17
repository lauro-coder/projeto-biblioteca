@if (session('sucesso'))
    <div class="flex items-start gap-3 rounded-lg bg-emerald-50 p-4 text-emerald-800 ring-1 ring-emerald-200 mb-6">
        <x-icone nome="sucesso" class="w-5 h-5 shrink-0 text-emerald-500" />
        <p class="text-sm font-medium">{{ session('sucesso') }}</p>
    </div>
@endif

@if (session('erro'))
    <div class="flex items-start gap-3 rounded-lg bg-red-50 p-4 text-red-800 ring-1 ring-red-200 mb-6">
        <x-icone nome="erro" class="w-5 h-5 shrink-0 text-red-500" />
        <p class="text-sm font-medium">{{ session('erro') }}</p>
    </div>
@endif

@if ($errors->any())
    <div class="flex items-start gap-3 rounded-lg bg-red-50 p-4 text-red-800 ring-1 ring-red-200 mb-6">
        <x-icone nome="erro" class="w-5 h-5 shrink-0 text-red-500" />
        <div>
            <p class="text-sm font-semibold">Verifique os erros abaixo:</p>
            <ul class="mt-1 list-disc ms-5 text-sm">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
