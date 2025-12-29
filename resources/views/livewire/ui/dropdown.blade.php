@php
    $label = $options[$value] ?? ($defaultLabel ?? (array_values($options)[0] ?? 'Pilih'));
    $menuId = uniqid('dd_');
@endphp

<div x-data="{ open: false }" class="relative" @click.away="open = false">
    <button type="button" @click="open = !open"
        class="w-full bg-white border border-gray-200 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 outline-none cursor-pointer shadow-sm flex items-center justify-between gap-3 hover:bg-gray-50 transition-all focus:ring-2 focus:ring-black/90"
        aria-haspopup="listbox" :aria-expanded="open" :aria-controls="'{{ $menuId }}'">
        <span>{{ $label }}</span>
        <x-lucide-chevron-up class="w-4 h-4 transition-transform duration-200 flex-shrink-0"
            x-bind:class="{ 'rotate-180': open }" />
    </button>

    <div x-show="open" x-transition id="{{ $menuId }}"
        class="absolute flex flex-col top-12 left-0 w-full bg-white border border-gray-100 rounded-xl shadow-lg z-50 overflow-hidden">
        @foreach ($options as $optValue => $optLabel)
            <button type="button" wire:click="setValue('{{ $optValue }}')" @click="open = false"
                class="w-full text-left px-4 py-2 hover:bg-gray-50 text-sm font-medium transition-colors {{ !$loop->last ? 'border-b border-gray-100' : '' }} {{ $value === $optValue ? 'bg-indigo-50 text-indigo-700' : '' }}">
                {{ $optLabel }}
            </button>
        @endforeach
    </div>
</div>
