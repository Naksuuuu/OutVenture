@props([
    'type' => 'success', // success, error, warning, info
    'dismissible' => false,
])

@php
$styles = [
    'success' => 'bg-green-50 border-green-200 text-green-700',
    'error' => 'bg-red-50 border-red-200 text-red-700',
    'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
    'info' => 'bg-blue-50 border-blue-200 text-blue-700',
];

$alertClass = $styles[$type] ?? $styles['info'];
@endphp

<div 
    {{ $attributes->merge(['class' => 'border rounded-md px-4 py-3 text-sm ' . $alertClass]) }}
    @if($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif
>
    @if($dismissible)
        <div class="flex items-start justify-between gap-3">
            <div class="flex-1">{{ $slot }}</div>
            <button @click="show = false" class="text-current opacity-70 hover:opacity-100 transition-opacity">
                <x-lucide-x class="w-4 h-4" />
            </button>
        </div>
    @else
        {{ $slot }}
    @endif
</div>
