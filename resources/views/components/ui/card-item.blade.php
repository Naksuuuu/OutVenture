@props([
    'padding' => 'p-6',
    'rounded' => 'rounded-2xl',
    'border' => 'border border-gray-200',
    'shadow' => 'shadow-sm',
    'hover' => 'hover:shadow-md',
])

<div {{ $attributes->merge(['class' => "bg-white $rounded $border $shadow $hover transition-all $padding"]) }}>
    {{ $slot }}
</div>