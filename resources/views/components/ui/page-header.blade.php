@props([
    'title' => '',
    'subtitle' => null,
    'gap' => 'gap-4 md:gap-6',
    'margin' => 'mb-6 md:mb-8',
])

<div {{ $attributes->merge(['class' => "flex flex-col md:flex-row justify-between items-start md:items-center $gap $margin"]) }}>
    <div>
        @if($title !== '')
            <h2 class="text-2xl font-bold text-gray-900">{{ $title }}</h2>
        @endif
        @if($subtitle)
            <p class="text-slate-500 mt-1 md:mt-2 font-medium">{{ $subtitle }}</p>
        @endif
    </div>

    <div class="w-full md:w-auto">
        {{ $actions ?? $slot }}
    </div>
</div>
