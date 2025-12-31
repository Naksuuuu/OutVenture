@props(['product', 'selectedColor' => null])

@php
    // Priority: selectedColor > latestVariant > first variant
    $displayVariant = null;

    // If color is selected, try to find variant with that color
    if ($selectedColor) {
        $displayVariant = $product->variants->where('id_color', $selectedColor)->first();
    }

    // If no color selected or not found, use latestVariant if available
    if (!$displayVariant && isset($product->latestVariant)) {
        $displayVariant = $product->latestVariant;
    }

    // Fallback to first variant
    if (!$displayVariant) {
        $displayVariant = $product->variants->first();
    }
@endphp

<a href="{{ route('products.show', $product) }}" wire:navigate class="flex flex-col">
    <div class="relative aspect-[4/5] bg-[#f2f2ed] mb-3 overflow-hidden">
        @if ($displayVariant && $displayVariant->image)
            <img src="{{ asset('storage/' . $displayVariant->image) }}" alt="{{ $product->nama_product }}"
                class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
    </div>

    <div class="flex flex-col">
        <span class="text-[10px] font-bold text-black tracking-tight uppercase mb-0.5">
            {{ $product->brand->nama_brand ?? 'Brand' }}
        </span>

        <h4 class="text-[13px] font-medium leading-tight text-black mb-1 uppercase tracking-tighter">
            {{ $product->nama_product }}
        </h4>

        <p class="text-[11px] text-gray-500 mb-1">Tersedia
            {{ $product->variants_count ?? $product->variants->count() }}
            Variants
        </p>

        <div class="text-[13px] font-bold">
            <span class="text-gray-500 mr-1 font-normal">From</span>
            {{ Number::currency($product->min_price ?? 0, 'IDR', 'id', precision: 0) }}
        </div>
    </div>
</a>