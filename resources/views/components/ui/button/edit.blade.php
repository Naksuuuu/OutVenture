@props([
    'href' => '#',
    'label' => '',
    'icon' => 'square-pen',
    'size' => 'size-4',
])

<a href="{{ $href }}" wire:navigate
    {{ $attributes->merge(['class' => 'flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-bold text-indigo-600 bg-indigo-50/50 rounded-xl hover:bg-indigo-600 hover:text-white transition-all uppercase tracking-wider']) }}>

    <x-dynamic-component :component="'lucide-' . $icon" :class="$size" />

    @if ($label)
        <span>{{ $label }}</span>
    @else
        {{ $slot }}
    @endif
</a>
