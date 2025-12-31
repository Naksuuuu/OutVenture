<div class="w-full px-6 md:px-10 py-10">

    @forelse ($trustedBrands as $brand)
        <x-ui.section-header title="{{ $brand->nama_brand }}" cta-text="LIHAT BRAND INI"
            cta-url="{{ route('brands.show', $brand) }}" />

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-12 mb-24">
            @forelse ($brand->products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-8 text-gray-500">
                    <p>Belum ada produk</p>
                </div>
            @endforelse
        </div>
    @empty
        <div class="bg-gray-50 rounded-2xl p-12 text-center">
            <p class="text-gray-500 text-lg">Belum ada brand tersedia</p>
        </div>
    @endforelse
</div>