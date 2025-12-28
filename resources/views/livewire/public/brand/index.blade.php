<div class="w-full px-6 md:px-10 py-10">

    @foreach ($trustedBrands as $brand)
        <div class="flex justify-between items-end mb-8 pb-2">
            <h3 class="text-3xl md:text-5xl font-black uppercase tracking-tighter text-black leading-none">
                {{ $brand->nama_brand }}
            </h3>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-12 mb-24">
            @foreach ($brand->products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    @endforeach
</div>
