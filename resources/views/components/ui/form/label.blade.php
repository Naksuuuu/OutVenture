@props([
    'label' => 'Label',
])


   <label
    {{ $attributes->merge(['class' => 'block text-xs font-bold text-slate-600 uppercase mb-2 tracking-widest']) }}>{{ $label }}</label>
