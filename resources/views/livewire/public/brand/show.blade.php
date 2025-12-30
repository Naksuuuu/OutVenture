<div class="w-full pb-10 flex flex-col gap-20">

    <livewire:public.hero.show :brand="$brand" />

    <div class="grid grid-cols-2 px-4 md:px-10 md:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-12 mb-24">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <x-ui.empty-state 
                full
                icon="shopping-bag"
                title="Belum Ada Produk"
                message="Belum ada produk untuk brand ini"
            />
        @endforelse
    </div>
    @if ($products->hasPages())
        <div class="px-4 md:px-10 mt-8">
            {{ $products->links() }}
        </div>
    @endif
</div>
