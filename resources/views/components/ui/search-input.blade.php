@props([
    'placeholder' => 'Cari...',
    'model' => null,
    'width' => 'md:w-64',
])

<div class="relative w-full {{ $width }}">
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
        <x-lucide-search class="w-4 h-4" />
    </span>
    <input
        @if($model) wire:model.live.debounce="{{ $model }}" @endif
        type="text"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 bg-white shadow-sm text-sm']) }}
    />
</div>
