{{-- <div>
    <h1 class="text-3xl font-bold">Welcome to Outventure</h1>
    <p class="mt-4">Your adventure starts here!</p>

    <div class="mt-8">
        <a href="{{ route('products.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
            Browse Products
        </a>
    </div>
</div> --}}





{{-- @php
    $categories = [
        ['name' => 'TENDA', 'image' => 'images/tenda.jpg'],
        ['name' => 'SEPATU', 'image' => 'images/sepatuhiking.jpg'],
        ['name' => 'MATRAS', 'image' => 'images/matras.jpg'],
        ['name' => 'TAS', 'image' => 'images/tas.jpg'],
        ['name' => 'JAKET', 'image' => 'images/gorpcore.jpg'],
        ['name' => 'TOPI', 'image' => 'images/topi.jpg'],
        ['name' => 'KOMPOR', 'image' => 'images/kompor.jpg'],
        ['name' => 'KURSI LIPAT', 'image' => 'images/kursilipat.jpg'],
        ['name' => 'SLEEPING BAG', 'image' => 'images/sleepingbag.jpg'],
        ['name' => 'MEJA LIPAT', 'image' => 'images/mejalipat.jpg'],
    ];
@endphp --}}


{{-- images/tenda.jpg' --}}


<div class="w-full flex flex-col items-center gap-20">

    <div class="text-center w-full md:h-[600px] relative">
        <img src="{{ asset('images/herosection/herotent.jpg') }}" alt="Banner Tenda"
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
            {{-- @php
                $brands = [
                    ['name' => 'THE NORTH FACE', 'image' => 'images/thenorthface.jpg'],
                    ['name' => 'EIGER', 'image' => 'images/taseiger.jpg'],
                    ['name' => 'CONSINA', 'image' => 'images/sepatuconsina.jpg'],
                    ['name' => 'CONSINA', 'image' => 'images/sepatuconsina.jpg'],
                ];
            @endphp --}}
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


    <div class="w-full px-2.5 bg-slate-100">
        tes
    </div>

</div>
