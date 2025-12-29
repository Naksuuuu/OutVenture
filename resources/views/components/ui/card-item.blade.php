@props([
    'padding' => 'p-0',
    'rounded' => 'rounded-lg',
    'border' => 'border border-gray-200',
    'shadow' => 'shadow-sm',
    'hover' => 'hover:shadow-md',
])

<div {{ $attributes->merge(['class' => "bg-white $rounded $border $shadow $hover transition-all $padding"]) }}>

    @if (isset($header))
        <div {{ $header->attributes->merge(['class' => 'mb-4']) }}>
            {{ $header }}
        </div>
    @endif

    {{ $slot }}

    @if (isset($footer))
        <div {{ $footer->attributes->merge(['class' => 'mt-4']) }}>
            {{ $footer }}
        </div>
    @endif

</div>
