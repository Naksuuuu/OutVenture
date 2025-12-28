@props([
    'title',
    'ctaText' => null,
    'ctaUrl' => null,
])

<div {{ $attributes->merge(['class' => 'flex justify-between items-end mb-8 border-b border-gray-100 pb-4']) }}>
    <h2 class="text-3xl font-black uppercase tracking-tighter">{{ $title }}</h2>
    
    @if($ctaText && $ctaUrl)
        <a href="{{ $ctaUrl }}" wire:navigate
            class="group flex items-center gap-2 bg-black text-white px-6 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
            {{ $ctaText }}
            <x-lucide-arrow-right class="h-4 w-4 transition-transform group-hover:translate-x-1" />
        </a>
    @endif
    
    {{ $slot }}
</div>
