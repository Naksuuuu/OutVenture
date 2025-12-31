<div class="w-full flex flex-col items-center">


    <x-ui.hero :brands="$brands" />


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
                        <select wire:model.live="selectedBrand"
                            class="appearance-none bg-white border border-gray-300 rounded px-4 py-2 pr-10 text-[15px] text-gray-700 focus:outline-none focus:border-gray-500 cursor-pointer">
                            <option value="">Brand</option>
                            @foreach ($allBrands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->nama_brand }}</option>
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

                    @if ($selectedCategory || $selectedBrand || $selectedColor || $selectedSize)
                        <button wire:click="clearFilters"
                            class="text-xs font-semibold text-gray-500 hover:text-red-600 underline underline-offset-4 ml-2">
                            RESET
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="w-full px-4 md:px-10 mb-20 bg-white">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @forelse ($products as $product)
                <x-product-card :product="$product" :selectedColor="$selectedColor" />
            @empty
                <div class="col-span-5">
                    <x-ui.empty-state full icon="package-open" title="Belum Ada Produk Tersedia" padding="p-2" class="py-2!"
                        message="Tunggu Admin Menambahkan Produk!" shadow="shadow-none" border="border-0"
                        rounded="rounded-2xl" />
                </div>
            @endforelse
        </div>

        <div class="px-6 py-4 ">
            {{ $products->links('components.ui.pagination') }}
        </div>
    </div>

</div>