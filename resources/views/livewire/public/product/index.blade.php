<div class="w-full flex flex-col items-center gap-20">

    <div class="w-full border-t border-b border-gray-500 bg-white">
        <div class="w-full px-4 md:px-10 py-4">
            <div class="flex flex-wrap items-center gap-4">
                <!-- Category Filter -->
                <div class="relative">
                    <select wire:model.live="selectedCategory"
                        class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm font-bold uppercase tracking-tight text-black focus:outline-none focus:ring-2 focus:ring-black cursor-pointer">
                        <option value="">ALL CATEGORIES</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
                        @endforeach
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor"
                        class="w-3.5 h-3.5 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>

                <!-- Color Filter -->
                <div class="relative">
                    <select wire:model.live="selectedColor"
                        class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm font-bold uppercase tracking-tight text-black focus:outline-none focus:ring-2 focus:ring-black cursor-pointer">
                        <option value="">ALL COLORS</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->nama_warna }}</option>
                        @endforeach
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor"
                        class="w-3.5 h-3.5 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>

                <!-- Clear Filters -->
                @if ($selectedCategory || $selectedColor)
                    <button wire:click="clearFilters"
                        class="px-4 py-2 text-sm font-bold uppercase tracking-tight text-red-600 hover:text-red-800 transition-colors">
                        RESET FILTERS
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="w-full px-4 md:px-10 py-12 bg-white">
        <h3 class="text-xl font-bold uppercase mb-6 tracking-tight">PRODUK TERBARU</h3>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @forelse ($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Tidak ada produk ditemukan</p>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
