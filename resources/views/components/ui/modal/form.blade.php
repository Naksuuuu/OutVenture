@props([
    'open' => false,
    'title' => 'Form Modal',
    'subtitle' => null,
    'submitAction' => 'save',
    'submitLabel' => 'Simpan',
    'cancelLabel' => 'Batal',
    'submitColor' => 'indigo', // deprecated, use submitVariant
    'submitVariant' => null, // create, update, delete
    'maxWidth' => 'max-w-lg',
    'wireKey' => null,
])

@php
    // Map legacy colors to variants if variant not explicitly set
    if (!$submitVariant) {
        $submitVariant = match($submitColor) {
            'emerald' => 'update',
            'red' => 'delete',
            default => 'create', // indigo maps to create
        };
    }
@endphp

@php
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $wireModel = $wireModel ? str_replace('wire:model.', '', $wireModel) : 'open';
@endphp

<div x-data="{ 
    isOpen: @entangle($wireModel).live 
}" 
    @if($wireKey) wire:key="{{ $wireKey }}" @endif>

    {{-- Trigger Button Slot --}}
    @if(isset($trigger))
        <div @click="isOpen = true">
            {{ $trigger }}
        </div>
    @endif

    <template x-teleport="body">
        <div x-show="isOpen" x-cloak class="fixed inset-0 z-[9999] overflow-y-auto">
            <div class="flex min-h-screen items-center justify-center p-4">
                {{-- Backdrop --}}
                <div x-show="isOpen" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"
                    @click="isOpen = false">
                </div>

                {{-- Modal Content --}}
                <div x-show="isOpen"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="relative w-full {{ $maxWidth }} bg-white rounded-[2rem] shadow-2xl border border-white/20 overflow-hidden">

                    {{-- Header --}}
                    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-white">
                        <div>
                            @if($subtitle)
                                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-[0.25em] mb-1">
                                    {{ $subtitle }}
                                </p>
                            @endif
                            <h3 class="text-lg font-bold text-slate-800">{{ $title }}</h3>
                        </div>
                        <button type="button" @click="isOpen = false"
                            class="text-slate-400 hover:text-slate-600 transition-colors">
                            <x-lucide-x class="w-6 h-6" />
                        </button>
                    </div>

                    {{-- Form Content --}}
                    <form wire:submit.prevent="{{ $submitAction }}" wire:loading.attr="disabled">
                        <div class="p-8 space-y-6">
                            {{ $slot }}
                        </div>

                        {{-- Footer --}}
                        <div class="bg-slate-50/80 px-8 py-6 flex items-center justify-end space-x-3">
                            <button type="button" @click="isOpen = false" wire:loading.attr="disabled"
                                class="text-xs font-bold text-slate-500 uppercase tracking-widest hover:text-slate-700 transition-colors disabled:opacity-50">
                                {{ $cancelLabel }}
                            </button>

                            <x-ui.button type="submit" 
                                :label="$submitLabel" 
                                :variant="$submitVariant" 
                                :loading-target="$submitAction"
                                />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>

