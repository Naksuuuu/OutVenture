<div class="w-full pb-10 flex flex-col gap-20">

    <livewire:public.hero.show :brandId="$brand->id" />

    <div class="grid grid-cols-2 px-4 md:px-10 md:grid-cols-3 lg:grid-cols-5 gap-x-6 gap-y-12 mb-24">
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
    @if ($products->hasPages())
        <div class="px-4 md:px-10 mt-8">
            {{ $products->links() }}
        </div>
    @endif
</div>
