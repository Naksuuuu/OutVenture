<div class="w-full h-[600px] relative overflow-hidden">
    @if ($brand->wide_image)
        <img src="{{ asset('storage/' . $brand->wide_image) }}" alt="{{ $brand->nama_brand }}"
            class="absolute inset-0 -z-10 h-full w-full object-cover">
    @else
        <div class="absolute inset-0 m-auto w-full h-full flex justify-center items-center flex-col gap-2">
            <x-lucide-image class="h-16 w-16 text-gray-400 " />
            {{ $brand->nama_brand }}
        </div>
    @endif

    <div
        class="relative flex justify-center items-center w-full h-full bg-black/30 text-2xl md:text-4xl font-semibold tracking-tight text-white uppercase mb-4">
        {{ $brand->nama_brand }} |
        @if ($brand->logo)
            <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->nama_brand }}"
                class="inline h-8 md:h-12 ml-4 object-contain">
        @else
            <x-lucide-image class="h-16 w-16 text-gray-400" />
        @endif
    </div>
</div>
