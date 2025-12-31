@props([
    'icon' => 'package',
    'title' => 'Tidak Ada Data',
    'message' => null,
    'buttonText' => null,
    'buttonUrl' => null,
    'shadow' => 'shadow-sm',
    'border' => 'border-gray-100',
    'rounded' => 'rounded-2xl',
    'padding' => 'p-16'
    ])

<div {{ $attributes->merge(['class' => 'col-span-full text-center py-12']) }}>
    @if($attributes->has('full'))
        <div class="bg-white {{ $rounded }} {{ $shadow }} {{ $padding }} {{ $border }}">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-full mb-6">
                <x-dynamic-component :component="'lucide-' . $icon" class="h-10 w-10 text-gray-400" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $title }}</h3>
            @if($message)
                <p class="text-gray-500 max-w-sm mx-auto mb-8 text-sm">{{ $message }}</p>
            @endif
            @if($buttonText && $buttonUrl)
                <a href="{{ $buttonUrl }}" wire:navigate
                    class="inline-block px-8 py-3 bg-black text-white font-bold rounded-lg hover:bg-gray-800 transition-all shadow-lg hover:shadow-black/20 uppercase text-sm tracking-wide">
                    {{ $buttonText }}
                </a>
            @endif
            {{ $slot }}
        </div>
    @else
        <p class="text-gray-500">{{ $message ?? $title }}</p>
    @endif
</div>
