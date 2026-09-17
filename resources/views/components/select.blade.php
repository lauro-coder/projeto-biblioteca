<select {{ $attributes->merge(['class' => 'border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm']) }}>
    {{ $slot }}
</select>
