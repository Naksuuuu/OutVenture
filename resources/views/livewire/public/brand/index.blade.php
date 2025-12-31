<div class="w-full px-6 md:px-10 py-10">

    @forelse ($trustedBrands as $brand)
        <x-ui.section-header title="{{ $brand->nama_brand }}" cta-text="LIHAT BRAND INI"
            cta-url="{{ route('brands.show', $brand) }}" />

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-12 mb-24">
            @forelse ($brand->products as $product)
                <x-product-card :product="$product" />
            @empty
                <x-ui.empty-state full icon="shopping-bag" title="Produk Kosong" message="Belum ada produk untuk brand ini"
                    padding="p-2" class="py-2!" shadow="shadow-none" border="border-0" rounded="rounded-2xl" />
            @endforelse
        </div>
    @empty
        <x-ui.empty-state full title="Tidak Ada Brand" message="Belum ada brand tersedia saat ini" />
    @endforelse
</div>