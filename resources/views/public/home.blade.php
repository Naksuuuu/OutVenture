@extends('layouts.app')

{{-- Menetapkan Judul Halaman --}}
@section('title', 'Home')

@section('content')

    {{-- Container utama, membatasi lebar agar konten terpusat (Sesuai Desain Figma) --}}
    {{-- Max-w-6xl dipilih karena cocok untuk tampilan desktop yang tidak terlalu lebar --}}
    <div class="container mx-auto max-w-6xl px-4 pt-4">

       {{-- 0. NAVIGASI ATAS UTAMA (PRODUK, KATEGORI, BRAND PILIHAN, SETTINGS) --}}

{{-- Header OUTVENTURE (Logo/Branding) --}}
<div class="text-center pt-4 pb-2">
    <h3 class="text-3xl font-bold uppercase tracking-widest text-gray-800">OUTVENTURE</h3>
</div>

{{-- Link Navigasi Utama (Baris di bawah Logo) --}}
<div class="flex justify-center items-center py-4 border-b border-gray-100 mb-8">
    <nav class="flex space-x-10 text-sm font-bold text-gray-700 tracking-wider">
        <a href="#" class="hover:text-black uppercase">PRODUK</a>
        <a href="#" class="hover:text-black uppercase">KATEGORI</a>
        <a href="#" class="hover:text-black uppercase">BRAND PILIHAN</a>
        <a href="#" class="hover:text-black uppercase">SETTINGS</a>
    </nav>
</div>


        {{-- 1. BANNER BESAR (FOTO TENDA YANG GEDEE) --}}
        <div class="text-center mb-10">
            <img 
                src="{{ asset('images/fototendagede.jpg') }}" 
                alt="Banner Tenda" 
                class="w-full h-[450px] object-cover rounded-lg shadow-xl"
            >
        </div>


        {{-- 2. DAFTAR PRODUK KATEGORI --}}
        <div class="mb-12">
            
            {{-- BARIS TOMBOL HITAM (PRODUK TENDA & SEMUA PRODUK) --}}
            {{-- Menggunakan Flex untuk menempatkan dua tombol berdampingan --}}
            <div class="flex space-x-2 mb-6">
                
                {{-- Tombol SEMMUA PRODUK --}}
                <a href="#" class="bg-black text-white font-bold text-sm uppercase px-6 py-3 tracking-wider hover:bg-gray-800 transition duration-200">
                    SEMUA PRODUK
                </a>
            </div>
            
            {{-- Kategori Ikon berada di bawah tombol --}}
            <h3 class="text-xl font-bold uppercase mb-4 tracking-tight hidden">SEMUA PRODUK</h3>
            
            {{-- Menggunakan GRID untuk penempatan 10 item yang presisi --}}
            <div class="grid grid-cols-5 md:grid-cols-10 gap-y-4 gap-x-2">
                
                {{-- Data Kategori Produk (10 Item) --}}
                @php
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
                @endphp

                @foreach ($categories as $category)
                    <div class="text-center"> 
                        <a href="#" class="block no-underline text-gray-800 hover:text-black">
                            <img src="{{ asset($category['image']) }}" alt="{{ $category['name'] }}" 
                                 class="mx-auto w-16 h-16 rounded-full object-cover shadow-sm border border-gray-100"
                            >
                            <p class="mt-2 text-[10px] uppercase font-medium">{{ $category['name'] }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


        {{-- 3. BRAND PILIHAN --}}
        <div class="mb-12">
            <h3 class="text-xl font-bold uppercase mb-4 tracking-tight">BRAND PILIHAN</h3>
            
            {{-- Menggunakan Flexbox untuk 3 card yang sejajar --}}
            <div class="flex flex-wrap -mx-2">
                
                {{-- Data Brand Pilihan (3 Item) --}}
                @php
                    // Pastikan jalur gambar ini BENAR
                    $brands = [
                        ['name' => 'THE NORTH FACE', 'image' => 'images/thenorthface.jpg'],
                        ['name' => 'EIGER', 'image' => 'images/taseiger.jpg'],
                        ['name' => 'CONSINA', 'image' => 'images/sepatuconsina.jpg'],
                    ];
                @endphp

                @foreach ($brands as $brand)
                    {{-- Brand Card: Lebar 1/3 di desktop --}}
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <div class="relative text-white rounded-lg overflow-hidden shadow-lg group">
                            
                            {{-- GAMBAR BRAND --}}
                            {{-- Perhatikan h-80 (tinggi) --}}
                            <img src="{{ asset($brand['image']) }}" class="w-full h-80 object-cover opacity-80 group-hover:opacity-90 transition duration-300" alt="{{ $brand['name'] }}">
                            
                            {{-- OVERLAY DAN KONTEN (sudah diperbaiki) --}}
                            <div class="absolute inset-0 p-6 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end">
                                {{-- Judul --}}
                                <h5 class="text-2xl font-bold uppercase text-white mb-3">{{ $brand['name'] }}</h5>
                                
                                {{-- Tombol BELI SEKARANG --}}
                                <a href="#" class="inline-block border border-white text-white text-sm font-medium px-4 py-2 w-fit hover:bg-white hover:text-black transition duration-300">
                                    BELI SEKARANG &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        {{-- 4. Logout Form --}}
        @auth
        <form action="{{ route('logout') }}" method="POST" class="mt-8">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                Logout
            </button>
        </form>
        @endauth
    </div>

    {{-- 5. FOOTER (Kode yang diminta) --}}
    {{-- Diletakkan di luar div container utama agar membentang penuh di bg-gray-100, --}}
    {{-- tetapi kontennya tetap dibatasi oleh max-w-6xl di dalamnya. --}}

   
    
@endsection