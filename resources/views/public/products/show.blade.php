@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <div class="w-full border-t border-gray-200 bg-white">
        <div class="w-full px-4 md:px-10 py-3">
            <div class="flex items-center gap-2 text-[12px] font-bold uppercase tracking-widest text-gray-400">
                <a href="/" class="hover:text-black transition-colors">HOME</a>
                <span class="text-gray-300">/</span>
                <span class="text-black">PRODUCT DETAIL</span>
            </div>
        </div>
    </div>

    <div class="w-full px-4 md:px-10 pt-0 pb-10 bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <div class="lg:col-span-7">
                <div class="relative bg-[#f2f2ed] aspect-[4/5] w-full overflow-hidden">
                    <img src="{{ asset('images/jakettnf.jpg') }}" alt="Product Image" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col pt-4 lg:pt-0">
                <span class="text-[12px] font-bold text-black tracking-widest uppercase mb-1">THE NORTH FACE</span>
                <h1 class="text-2xl md:text-3xl font-bold leading-tight text-black mb-4 uppercase tracking-tighter">
                    Men Mountain Light Triclimate® GORE-TEX® Jacket
                </h1>

                <div class="mb-8 flex flex-col gap-1">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-black">Rp 2.965.000</span>
                        {{-- <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg> --}}
                    </div>
                </div>

                <div class="mb-8">
                    <span class="text-[11px] font-bold uppercase mb-3 block">Colour:
                        <span class="font-normal text-gray-600">BLACK</span>
                    </span>
                    <div class="flex gap-2">
                        <button class="w-16 h-20 border-2 border-black p-1">
                            <img src="{{ asset('images/jakettnf.jpg') }}" class="w-full h-full object-cover bg-[#f2f2ed]">
                        </button>
                    </div>
                </div>

                <div class="mb-8">
                    <span class="text-[11px] font-bold uppercase mb-3 block">Clothing Size:
                        <span class="font-normal text-gray-600 text-[10px]">XS</span>
                    </span>
                    <div class="grid grid-cols-4 gap-2">
                        @php $sizes = ['XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL']; @endphp
                        @foreach ($sizes as $size)
                            <button
                                class="relative border border-gray-200 py-3 text-[11px] font-bold hover:border-black transition-colors uppercase
                                {{ $size == 'XS' ? 'border-black bg-black text-white' : '' }}
                                {{ in_array($size, ['XXS', 'XXL', 'XXXL']) ? 'bg-gray-50 text-gray-300' : '' }}">
                                {{ $size }}
                                @if (in_array($size, ['XXS', 'XXL', 'XXXL']))
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-full h-[1px] bg-gray-300 -rotate-45"></div>
                                    </div>
                                @endif
                            </button>
                        @endforeach
                    </div>

                    <p class="text-[11px] text-gray-500 mt-3 italic">Catatan Ukuran: Model ini ukurannya besar. Pilih ukuran
                        yang lebih kecil untuk ukuran yang paling pas.</p>
                </div>

                <div class="space-y-3 mb-10">
                    <button
                        class="w-full bg-black text-white py-5 text-[11px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-colors">
                        TAMBAHKAN KE KERANJANG
                    </button>
                </div>

                <div class="border-t border-black">
                    <button class="w-full py-4 flex justify-between items-center">
                        <span class="text-[12px] font-bold uppercase tracking-widest">DESCRIPTION</span>
                        <span class="text-xl">—</span>
                    </button>
                    <div class="pb-8">
                        <p class="text-[13px] leading-relaxed text-gray-600 mb-4">
                            <span class="font-bold text-black uppercase">The North Face Men Mountain Light Triclimate®
                                GORE-TEX® Jacket</span><br><br>
                            Warisan pegunungan besar berpadu dengan kemampuan beradaptasi. Kami membuat Jaket GORE-TEX®
                            Triclimate® Mountain Light Pria dengan perlindungan terbaik di kelasnya terhadap berbagai
                            kondisi cuaca. Dua jaket terpisah namun terintegrasi ini dapat dikenakan dengan tiga cara
                            berbeda tergantung pada cuaca dan aktivitas. Jaket shell GORE-TEX® kompatibel dengan jaket liner
                            berinsulasi bulu angsa yang juga tahan air sehingga Anda dapat beraktivitas di luar ruangan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
