<div class="w-full flex flex-col items-center gap-20">



    <livewire:public.hero.index />





    <div class="w-full px-4 md:px-10 ">

        <div class="flex w-full overflow-x-auto px-10 flex-nowrap gap-10 lg:gap-20 scrollbar-hide">

            @forelse ($categories as $category)
                <div class="flex flex-col items-center gap-2 min-w-[120px]">
                    @if ($category->image)
                        <div class="w-30 h-30 lg:w-40 lg:h-40 bg-gray-200 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->nama_category }}"
                                class="mx-auto object-cover w-full h-full rounded-lg">
                        </div>
                    @else
                        <div class="w-30 h-30 lg:w-40 lg:h-40 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />

                            </svg>
                        </div>
                    @endif

                    <p class="uppercase font-medium tracking-tight text-center">
                        {{ $category->nama_category }}</p>

                </div>
            @empty
                <div class="w-full text-center py-12">
                    <p class="text-gray-500">Belum ada kategori</p>
                </div>
            @endforelse

        </div>

    </div>



    <div class="w-full px-4 md:px-10">
        <div class="flex justify-between items-end mb-8 border-b border-gray-100 pb-4">
            <h2 class="text-3xl font-black uppercase tracking-tighter">BRAND PILIHAN</h2>
            <a href="{{ route('products.index') }}" wire:navigate
                class="group flex items-center gap-2 bg-black text-white px-6 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
                LIHAT SEMUA BRAND
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />

                </svg>
            </a>
        </div>

        <div class="flex flex-wrap group/brands">




            @forelse ($brands as $brand)
                <div
                    class="w-full lg:w-1/4 md:w-1/2 px-2 mb-6 lg:mb-0 transition-all duration-300 delay-150 lg:group-hover/brands:w-[22%] lg:hover:!w-[34%]">
                    <div class="relative text-white rounded-lg overflow-hidden shadow-lg group">
                        @if ($brand->image)
                            <img src="{{ asset('storage/' . $brand->image) }}"
                                class="w-full h-80 object-cover opacity-80 group-hover:opacity-90 transition duration-300"
                                alt="{{ $brand->nama_brand }}">
                        @else
                            <div
                                class="w-full h-80 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div
                            class="absolute inset-0 p-6 bg-gradient-to-t from-black/60 to-black/10 flex flex-col justify-end">
                            <h5 class="text-2xl font-bold uppercase text-white mb-3">
                                {{ $brand->nama_brand }}</h5>
                            <a href="{{ route('brands.show', $brand->id) }}"
                                class="inline-block border border-white text-white text-sm font-medium px-4 py-2 w-fit hover:bg-white hover:text-black transition duration-300">
                                BELI SEKARANG &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-12">
                    <p class="text-gray-500">Belum ada brand pilihan</p>
                </div>
            @endforelse
        </div>
    </div>
    @php
        $features = [
            [
                'icon' => 'gem',
                'title' => 'TRUSTED GEAR',
                'description' => 'MENYEDIAKAN UNIT ORIGINAL YANG TERUJI DI ALAM LIAR',
            ],
            [
                'icon' => 'star',
                'title' => 'ELITE QUALITY',
                'description' => 'STANDAR EKSPEDISI DENGAN MATERIAL TERBAIK DI KELASNYA',
            ],
            [
                'icon' => 'panels-top-left',
                'title' => 'AUTHORIZED HUB',
                'description' => 'SALURAN RESMI BERBAGAI BRAND OUTDOOR TERNAMA DALAM SATU PLATFORM',
            ],
            [
                'icon' => 'users',
                'title' => 'EXPLORER HUB',
                'description' => 'RUANG KOLABORASI DAN EDUKASI BAGI PARA PENJELAJAH',
            ],
        ];
    @endphp

    <div class="w-full border-y border-gray-200 bg-white">
        <div class="grid grid-cols-1 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-200">
            @foreach ($features as $feature)
                <div class="flex items-center gap-4 p-6 justify-center">
                    <div class="p-2 border border-gray-400 rounded-sm">
                        <x-dynamic-component :component="'lucide-' . $feature['icon']" class="w-5 h-5" />
                    </div>
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider">{{ $feature['title'] }}</h4>
                        <p class="text-[10px] text-gray-500 uppercase">{{ $feature['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="w-full px-4 md:px-10 mb-10">
        <div class="flex justify-between items-end mb-8 border-b border-gray-100 pb-4">
            <h2 class="text-3xl font-black uppercase tracking-tighter">KOLEKSI TERBARU</h2>
            <a href="{{ route('products.index') }}" wire:navigate
                class="group flex items-center gap-2 bg-black text-white px-6 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
                LIHAT SEMUA PRODUK
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />

                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @forelse ($latestProducts as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Belum ada produk tersedia</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
