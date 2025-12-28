@props([
    'icon' => 'image',
    'size' => 'md', // sm, md, lg
])

@php
$sizeClasses = [
    'sm' => 'h-12 w-12',
    'md' => 'h-16 w-16',
    'lg' => 'h-32 w-32',
];
$iconSize = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center justify-center']) }}>
    <x-dynamic-component :component="'lucide-' . $icon" class="{{ $iconSize }} text-gray-400" />
</div>
