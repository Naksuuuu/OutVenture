@props([
    'model',
    'image' => null,
    'label' => 'Upload Baru',
    'instruction' => 'Pilih File',
    'aspect' => 'aspect-square',
])

<div class="relative group {{ $attributes->get('class') }}">
    <x-ui.form.label label="{{ $label }}" />

    <div
        class="{{ $aspect }} rounded-2xl overflow-hidden bg-emerald-50 border-2 border-dashed border-emerald-200 flex items-center justify-center transition-all group-hover:border-emerald-400 relative hover:bg-emerald-100/50">

        {{-- Preview --}}
        @if ($image && method_exists($image, 'temporaryUrl'))
            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
        @else
            <div class="text-center p-2">
                <x-lucide-image class="size-12 text-emerald-300 mx-auto mb-1" />
                <span
                    class="text-[8px] font-black text-emerald-400 uppercase tracking-tighter">{{ $instruction }}</span>
            </div>
        @endif

        {{-- File Input --}}
        <input type="file" {{ $attributes->wire('model') }}
            class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
    </div>

    {{-- Error Message --}}
    @error($attributes->wire('model')->value())
        <span class="text-rose-500 text-[10px] mt-1 font-black uppercase block leading-tight">{{ $message }}</span>
    @enderror
</div>
