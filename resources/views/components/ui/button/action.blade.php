@props(['target', 'type' => 'button', 'label' => null])

<button type="{{ $type }}" wire:click="{{ $target }}" wire:loading.attr="disabled"
    {{ $attributes->merge([
        'class' =>
            'relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-black hover:bg-emerald-600 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition-all duration-200 ease-in-out shadow-md hover:shadow-emerald-200 overflow-hidden',
    ]) }}>

    <span wire:loading.class='opacity-0' wire:target="{{ $target }}" class="inline-flex items-center gap-2">
        <x-lucide-check class="size-4" />
        {{ $label ?? 'Simpan Perubahan' }}
    </span>



    <div wire:loading.flex wire:target="{{ $target }}"
        class="absolute w-full h-full top-0 right-0 flex items-center justify-center bg-inherit">
        <x-lucide-loader-circle class="size-5 animate-spin" />
    </div>


</button>
