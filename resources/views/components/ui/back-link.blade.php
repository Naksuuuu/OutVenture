@props([
    'href' => '#',
    'label' => 'Kembali',
    'iconClass' => 'w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform',
])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-slate-400 hover:text-slate-900 text-[11px] font-black uppercase tracking-[0.2em] transition-colors flex items-center group']) }}>
    <x-lucide-arrow-left class="{{ $iconClass }}" />
    {{ $label }}
</a>
