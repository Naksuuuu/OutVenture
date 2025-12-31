<div id="hero-section" class="w-full flex flex-col items-center gap-20">


    <x-ui.hero :brands="$brands" />





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
                            <x-ui.image-placeholder icon="image" />
                        </div>
                    @endif

                    <p class="uppercase font-medium tracking-tight text-center">
                        {{ $category->nama_category }}
                    </p>

                </div>
            @empty
                <x-ui.empty-state message="Belum ada kategori" class="w-full" />
            @endforelse

        </div>

    </div>



    <div class="w-full px-4 md:px-10">
        <x-ui.section-header title="BRAND PILIHAN" cta-text="LIHAT SEMUA BRAND" cta-url="{{ route('brands.index') }}" />

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
                                <x-ui.image-placeholder icon="image" size="lg" />
                            </div>
                        @endif
                        <div
                            class="absolute inset-0 p-6 bg-gradient-to-t from-black/60 to-black/10 flex flex-col justify-end">
                            <h5 class="text-2xl font-bold uppercase text-white mb-3">
                                {{ $brand->nama_brand }}
                            </h5>
                            <a href="{{ route('brands.show', $brand) }}"
                                class="inline-block border border-white text-white text-sm font-medium px-4 py-2 w-fit hover:bg-white hover:text-black transition duration-300">
                                BELI SEKARANG &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <x-ui.empty-state message="Belum ada brand pilihan" class="w-full" />
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
        <x-ui.section-header title="KOLEKSI TERBARU" cta-text="LIHAT SEMUA PRODUK"
            cta-url="{{ route('products.index') }}" />

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @forelse ($latestProducts as $product)
                <x-product-card :product="$product" />
            @empty
                <x-ui.empty-state message="Belum ada produk tersedia" />
            @endforelse
        </div>
    </div>

    {{-- Store Location Map --}}
    <div class="w-full px-4 md:px-10 mb-10">
        <div class="flex justify-between items-end mb-8 border-b border-gray-100 pb-4">
            <h2 class="text-3xl font-black uppercase tracking-tighter">LOKASI TOKO</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
            <div id="map" class="w-full h-[400px]" wire:ignore></div>
            <div class="p-6 bg-gray-50 border-t border-gray-100">
                <div class="flex items-start gap-3">
                    <x-lucide-map-pin class="w-5 h-5 text-gray-600 mt-1 flex-shrink-0" />
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">Outventure Store</h3>
                        <p class="text-sm text-gray-600">Gegerkalong, Kota Bandung, Jawa Barat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:navigated', function () {
                const mapElement = document.getElementById('map');

                if (mapElement && !mapElement._leaflet_id) {
                    // Koordinat Gegerkalong, Bandung (Plus Code: 4HMV+G2)
                    const lat = -6.8663;
                    const lng = 107.5926;

                    // Initialize map
                    const map = L.map('map').setView([lat, lng], 15);

                    // Add OpenStreetMap tiles
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        maxZoom: 19
                    }).addTo(map);

                    // Add marker
                    const marker = L.marker([lat, lng]).addTo(map);
                    marker.bindPopup('<b>Outventure Store</b><br>Gegerkalong, Bandung').openPopup();
                }
            });
        </script>
    @endpush

</div>