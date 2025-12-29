@props([
    'href' => '#',
    'label' => '',
    'icon' => 'plus',
    'size' => 'size-4',
])

<a href="{{ $href }}" wire:navigate
    {{ $attributes->merge(['class' => 'flex items-center justify-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white px-4 md:px-6 py-2 md:py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-slate-200 active:scale-95']) }}>

    <x-dynamic-component :component="'lucide-' . $icon" :class="$size" />

    @if ($label)
        <span>{{ $label }}</span>
    @else
        {{ $slot }}
    @endif
</a>
