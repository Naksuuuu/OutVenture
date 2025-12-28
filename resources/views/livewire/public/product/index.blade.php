<div class="w-full flex flex-col items-center">


    <livewire:public.hero.index />


    <div class="w-full shadow-sm  mb-20 border-gray-400 bg-white">
        <div class="w-full px-4 md:px-10 py-3">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                <div class="flex flex-wrap items-center gap-3">
                    <button
                        class="flex items-center gap-2 bg-[#1a1a1a] text-white px-4 py-2 rounded text-sm font-medium hover:bg-black transition-colors">
                        <x-lucide-sliders-horizontal class="w-4 h-4" />
                        Filter
                    </button>

                    <div class="relative">
                        <select wire:model.live="selectedCategory"
                            class="appearance-none bg-white border border-gray-300 rounded px-4 py-2 pr-10 text-[15px] text-gray-700 focus:outline-none focus:border-gray-500 cursor-pointer">
                            <option value="">Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <x-lucide-chevron-down class="w-4 h-4 text-gray-800" />
                        </div>
                    </div>

                    <div class="relative">
                        <select wire:model.live="selectedColor"
                            class="appearance-none bg-white border border-gray-300 rounded px-4 py-2 pr-10 text-[15px] text-gray-700 focus:outline-none focus:border-gray-500 cursor-pointer">
                            <option value="">Warna</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->nama_warna }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <x-lucide-chevron-down class="w-4 h-4 text-gray-800" />
                        </div>
                    </div>

                    @if ($selectedCategory)
                        <div class="relative">
                            <select wire:model.live="selectedSize"
                                class="appearance-none bg-white border border-gray-300 rounded px-4 py-2 pr-10 text-[15px] text-gray-700 focus:outline-none focus:border-gray-500 cursor-pointer">
                                <option value="">Ukuran</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->label_size }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <x-lucide-chevron-down class="w-4 h-4 text-gray-800" />
                            </div>
                        </div>
                    @endif

                    @if ($selectedCategory || $selectedColor || $selectedSize)
                        <button wire:click="clearFilters"
                            class="text-xs font-semibold text-gray-500 hover:text-red-600 underline underline-offset-4 ml-2">
                            RESET
                        </button>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-[15px] text-gray-600">Berdasarkan:</span>
                    <div class="relative">
                        <select wire:model.live="selectedSort"
                            class="appearance-none bg-white border border-gray-300 rounded px-4 py-2 pr-10 text-[15px] text-gray-700 focus:outline-none focus:border-gray-500 cursor-pointer">
                            <option value="latest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <x-lucide-chevron-down class="w-4 h-4 text-gray-800" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="w-full px-4 md:px-10 mb-20 bg-white">
        <div class="flex justify-between items-end mb-8 border-b border-gray-100 pb-4">
            <h3 class="text-3xl font-black uppercase tracking-tighter">SEMUA PRODUK</h3>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @forelse ($products as $product)
                <x-product-card :product="$product" :selectedColor="$selectedColor" />
            @empty
                <x-ui.empty-state message="Tidak ada produk ditemukan" />
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
