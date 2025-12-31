@props([
    'type' => 'button',
    'variant' => 'primary', 
    'size' => 'md', 
    'icon' => null,
    'iconPos' => 'left', 
    'label' => null,
    'loadingTarget' => null,
    'submitTarget' => null,
])

@php
    $baseClasses = 'relative inline-flex items-center justify-center gap-2 font-bold uppercase tracking-widest rounded-xl transition-all duration-200 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed group overflow-hidden';
    
    $variants = [
        // Create Variants (Blue)
        'create'       => 'bg-blue-600 hover:bg-blue-700 text-white shadow-md hover:shadow-blue-200 border border-transparent', // Default (Fill)
        'create-fill'  => 'bg-blue-600 hover:bg-blue-700 text-white shadow-md hover:shadow-blue-200 border border-transparent',
        'create-ghost' => 'bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white border border-blue-200',

        // Update Variants (Green)
        'update'       => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-md hover:shadow-emerald-200 border border-transparent', // Default (Fill)
        'update-fill'  => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-md hover:shadow-emerald-200 border border-transparent',
        'update-ghost' => 'bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white border border-emerald-200',

        // Show Variants (slate/Black)
        'show'         => 'bg-slate-900 hover:bg-slate-800 text-white shadow-md hover:shadow-slate-200 border border-transparent', // Default (Fill)
        'show-fill'    => 'bg-slate-900 hover:bg-slate-800 text-white shadow-md hover:shadow-slate-200 border border-transparent',
        'show-ghost'   => 'bg-slate-50 text-slate-600 hover:bg-slate-800 hover:text-white border border-slate-200',
        
        // Edit Variants (Green - Default Ghost)
        'edit'        => 'bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white border border-emerald-200',
        'edit-ghost'  => 'bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white border border-emerald-200',
        'edit-fill'   => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-md hover:shadow-emerald-200 border border-transparent',

        // Delete Variants (Red - Default Ghost)
        'delete'       => 'bg-red-50 text-red-600 hover:bg-red-600 hover:text-white border border-red-200',
        'delete-ghost' => 'bg-red-50 text-red-600 hover:bg-red-600 hover:text-white border border-red-200',
        'delete-fill'  => 'bg-red-600 hover:bg-red-700 text-white shadow-md hover:shadow-red-200 border border-transparent',
        
        // Fail-safes / Extras
        'primary' => 'bg-slate-900 hover:bg-slate-800 text-white shadow-md border border-transparent',
        'secondary' => 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:text-indigo-600 shadow-sm',
        'ghost' => 'bg-transparent text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 border border-transparent',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-[10px]',
        'md' => 'px-5 py-2.5 text-xs',
        'lg' => 'px-6 py-3 text-sm',
        // Icon only sizes (approximate)
        'icon-sm' => 'p-1.5',
        'icon-md' => 'p-2.5',
        'icon-lg' => 'p-3',
    ];

    // Determine if generic icon-only size should be used (when no label)
    $isIconOnly = ($label === null && $slot->isEmpty());
    
    if ($isIconOnly && !str_starts_with($size, 'icon-')) {
        $sizeKey = 'icon-' . $size;
    } else {
        $sizeKey = $size;
    }
    
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$sizeKey] ?? $sizes['md']);

    $iconSizeMap = [
        'sm' => 'w-3 h-3',
        'md' => 'w-4 h-4',
        'lg' => 'w-5 h-5',
        'icon-sm' => 'w-3 h-3',
        'icon-md' => 'w-4 h-4',
        'icon-lg' => 'w-5 h-5',
    ];

    $iconClasses = $iconSizeMap[$size] ?? 'w-4 h-4';
@endphp
    
<button type="{{ $type }}" 
    @if ($loadingTarget) wire:loading.attr="disabled" @endif
    {{ $attributes->merge(['class' => $classes]) }}>

    {{-- Loading Spinner Overlay --}}
    @if ($loadingTarget)
        <div wire:loading.flex wire:target="{{ $loadingTarget }}" class="absolute inset-0 items-center justify-center bg-inherit z-10">
            <x-lucide-loader-circle class="w-1/2 h-1/2 animate-spin" />
        </div>
    @endif

    {{-- Content --}}
    <span class="{{ $loadingTarget ? 'inline-flex items-center gap-2' : 'contents' }}" 
          @if ($loadingTarget) wire:loading.class="opacity-0" wire:target="{{ $loadingTarget }}" @endif>
        
        @if ($icon && $iconPos === 'left')
            <x-dynamic-component :component="'lucide-' . $icon" class="{{ $iconClasses }}" />
        @endif

        @if ($label)
            <span>{{ $label }}</span>
        @else
            {{ $slot }}
        @endif

        @if ($icon && $iconPos === 'right')
            <x-dynamic-component :component="'lucide-' . $icon" class="{{ $iconClasses }}" />
        @endif
    </span>
</button>
