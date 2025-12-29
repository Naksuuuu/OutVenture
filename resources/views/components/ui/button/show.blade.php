@props([
    'href' => '#',
    'label' => '',
    'icon' => 'eye',
    'size' => 'size-6',
])

<a href="{{ $href }}" wire:navigate
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 gap-2 bg-gray-900 hover:bg-gray-800 text-white text-xs font-bold rounded-xl transition-all shadow-sm']) }}>

    <x-dynamic-component :component="'lucide-' . $icon" :class="$size" />

    @if ($label)
        <span>{{ $label }}</span>
    @else
        {{ $slot }}
    @endif
</a>
