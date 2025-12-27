<div class="w-full h-[600px] relative overflow-hidden">
    @if ($brand->wide_image)
        <img src="{{ asset('storage/' . $brand->wide_image) }}" alt="{{ $brand->nama_brand }}"
            class="absolute inset-0 -z-10 h-full w-full object-cover">
    @else
        <img src="{{ asset('storage/herosection/herotent.jpg') }}" alt="Default Banner"
            class="absolute inset-0 -z-10 h-full w-full object-cover">
    @endif

    <div
        class="relative flex justify-center items-center w-full h-full bg-black/30 text-2xl md:text-4xl font-semibold tracking-tight text-white uppercase mb-4">
        {{ $brand->nama_brand }} |
        @if ($brand->logo)
            <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->nama_brand }}"
                class="inline h-8 md:h-12 ml-4 object-contain">
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />

            </svg>
        @endif
    </div>
</div>
