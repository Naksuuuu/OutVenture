<div class="w-full flex flex-col items-center gap-20">



    <div class="text-center w-full md:h-[600px] relative">

        <img src="{{ asset('storage/herosection/herotent.jpg') }}" alt="Banner Tenda"

            class="absolute -z-10 h-full w-full  object-cover ">

        <div class="relative p-10 flex flex-col items-center md:items-start md:justify-end w-full h-full bg-black/20">

            <a href="#" class="text-2xl md:text-4xl font-semibold tracking-tight text-white">OUTVENTURE</a>

            <div class="mt-4 space-x-2">

                <button class="group relative h-9 font-semibold overflow-hidden rounded-md bg-white px-4">

                    <div

                        class="flex h-9 w-fit items-center transition-transform duration-300 group-hover:-translate-y-9">

                        CONSINA

                    </div>

                    <div

                        class="flex h-9 w-fit items-center transition-transform duration-300 group-hover:-translate-y-9">

                        CONSINA

                    </div>



                </button>

                <button class="group relative h-9 font-semibold overflow-hidden rounded-md bg-black/70 text-white px-4">

                    <div class="flex h-9 items-center transition-transform duration-300 group-hover:-translate-y-9">

                        LIHAT SEMUA PRODUK

                    </div>

                    <div class="flex h-9 items-center transition-transform duration-300 group-hover:-translate-y-9">

                        LIHAT SEMUA PRODUK

                    </div>

                </button>



            </div>

        </div>

    </div>





    <div class="w-full px-4 md:px-10">

        <div class="flex w-full overflow-x-auto  flex-nowrap justify-between gap-10 scrollbar-hide ">

            @foreach ($categories as $category)

                <div class="flex flex-col items-center gap-2">

                    <img src="{{ asset($category['image']) }}" alt="{{ $category['name'] }}"

                        class="mx-auto object-cover max-w-30 ">



                    <p class="uppercase font-medium tracking-tight">{{ $category['name'] }}</p>

                </div>

            @endforeach

        </div>

    </div>



    <div class="w-full px-4 md:px-10">

        <h3 class="text-xl font-bold uppercase mb-4 tracking-tight">BRAND PILIHAN</h3>

        <div class="flex flex-wrap group/brands">

           

            @foreach ($brands as $brand)

                <div

                    class="w-full lg:w-1/4 md:w-1/2 px-2 mb-6 lg:mb-0 transition-all duration-300 delay-150 lg:group-hover/brands:w-[22%] lg:hover:!w-[34%]">

                    <div class="relative text-white rounded-lg overflow-hidden shadow-lg group">



                        {{-- GAMBAR BRAND --}}

                        <img src="{{ asset($brand['image']) }}"

                            class="w-full h-80 object-cover opacity-80 group-hover:opacity-90 transition duration-300"

                            alt="{{ $brand['name'] }}">



                        {{-- OVERLAY DAN KONTEN --}}

                        <div

                            class="absolute inset-0 p-6 bg-gradient-to-t from-black/60 to-black/10 flex flex-col justify-end">

                            <h5 class="text-2xl font-bold uppercase text-white mb-3">{{ $brand['name'] }}</h5>

                            <a href="#"

                                class="inline-block border border-white text-white text-sm font-medium px-4 py-2 w-fit hover:bg-white hover:text-black transition duration-300">

                                BELI SEKARANG &rarr;

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>




<div class="w-full border-y border-gray-200 bg-white">
    <div class="grid grid-cols-1 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-200">
        <div class="flex items-center gap-4 p-6 justify-center">
            <div class="p-2 border border-gray-400 rounded-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3h12l4 6-10 13L2 9Z"/><path d="M11 3 8 9l4 13 4-13-3-6"/><path d="M2 9h20"/></svg>
            </div>
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider">TRUSTED GEAR </h4>
                <p class="text-[10px] text-gray-500 uppercase">MENYEDIAKAN UNIT ORIGINAL YANG TERUJI DI ALAM LIAR</p>
            </div>
        </div>
        <div class="flex items-center gap-4 p-6 justify-center">
             <div class="p-2 border border-gray-400 rounded-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275Z"/></svg>
            </div>
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider">ELITE QUALITY</h4>
                <p class="text-[10px] text-gray-500 uppercase">STANDAR EKSPEDISI DENGAN MATERIAL TERBAIK DI KELASNYA</p>
            </div>
        </div>
        <div class="flex items-center gap-4 p-6 justify-center">
             <div class="p-2 border border-gray-400 rounded-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="5" y="5" rx="2"/><path d="M5 9h14"/><path d="M9 5v14"/></svg>
            </div>
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider">AUTHORIZED HUB</h4>
                <p class="text-[10px] text-gray-500 uppercase">SALURAN RESMI BERBAGAI BRAND OUTDOOR TERNAMA DALAM SATU PLATFORM</p>
            </div>
        </div>
        <div class="flex items-center gap-4 p-6 justify-center">
             <div class="p-2 border border-gray-400 rounded-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider">EXPLORER HUB</h4>
                <p class="text-[10px] text-gray-500 uppercase">RUANG KOLABORASI DAN EDUKASI BAGI PARA PENJELAJAH</p>
            </div>
        </div>
    </div>
</div>

<div class="w-full px-4 md:px-10 mt-10">
    <div class="flex justify-between items-end mb-8 border-b border-gray-100 pb-4">
        <h2 class="text-3xl font-black uppercase tracking-tighter">KOLEKSI TERBARU</h2>
        <a href="#" class="group flex items-center gap-2 bg-black text-white px-6 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
            LIHAT SEMUA PRODUK
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>

    {{-- <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        @foreach ($products as $product)
            <div class="flex flex-col gap-3 group cursor-pointer">
                <div class="relative aspect-[4/5] bg-[#F3F3F3] overflow-hidden">
                    @if($product['on_sale'])
                        <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded-sm z-10">SALE</span>
                    @endif
                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" 
                         class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500">
                </div>

                <div class="flex flex-col gap-1">
                    <img src="{{ asset($product['brand_logo']) }}" class="h-4 w-fit object-contain mb-1" alt="brand">
                    <h3 class="text-sm font-bold leading-tight uppercase tracking-tight group-hover:underline">
                        {{ $product['name'] }}
                    </h3>
                    <p class="text-xs text-gray-500">{{ $product['info'] ?? 'Available in multiple sizes' }}</p>
                </div>
            </div>
        @endforeach
    </div> --}}
</div>



    </div>

</div>


