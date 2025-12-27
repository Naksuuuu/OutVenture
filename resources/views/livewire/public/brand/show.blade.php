<div class="w-full pb-10 flex flex-col gap-20">

    <livewire:public.hero.show :brandId="$brand->id" />

    <div class="grid grid-cols-2 px-4 md:px-10 md:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-12 mb-24">
        @foreach ($products as $product)
            <a href="{{ route('products.show', $product->id) }}" wire:navigate class="group flex flex-col">

                <div class="relative aspect-[4/5] bg-[#f2f2ed] mb-4 overflow-hidden">
                    @if ($product->variants->first() && $product->variants->first()->image)
                        <img src="{{ asset('storage/' . $product->variants->first()->image) }}"
                            alt="{{ $product->nama_product }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col px-1">
                    <span class="text-[10px] font-bold text-black tracking-widest uppercase mb-1">
                        {{ $brand->nama_brand }}
                    </span>

                    <h4
                        class="text-[13px] font-bold leading-tight text-black mb-1 uppercase tracking-tight group-hover:underline">
                        {{ $product->nama_product }}
                    </h4>

                    <p class="text-[11px] text-gray-500 mb-1">
                        Available in {{ $product->variants->count() }} Variants
                    </p>

                    <div class="text-[13px] font-black mt-1 text-black">
                        <span class="text-gray-400 mr-1 font-normal text-[11px]">From</span>
                        {{ Number::currency($product->min_price, 'IDR', 'id', precision: 0) }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    @if ($products->hasPages())
        <div class="px-4 md:px-10 mt-8">
            {{ $products->links() }}
        </div>
    @endif
</div>
