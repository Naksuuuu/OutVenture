<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Efek glassmorphism halus */
        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-[#f8fafc] text-slate-900 antialiased">

    <div class="min-h-screen py-12 px-4 sm:px-6">
        <div class="max-w-5xl mx-auto">

            <nav class="flex mb-4 text-sm text-slate-500 space-x-2" aria-label="Breadcrumb">
                <span>Produk</span>
                <span>/</span>
                <span class="text-indigo-600 font-medium">Edit Produk</span>
            </nav>

            <div
                class="bg-white rounded-3xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden">

                <div
                    class="glass-header px-8 py-8 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold tracking-tight text-slate-800">Edit Data Produk</h1>
                            <p class="text-slate-500 text-sm italic">{{ $product->nama_product }}</p>
                        </div>
                    </div>
                </div>

                <form id="product-update-form" action="{{ route('admin.products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-8 md:p-10 space-y-10">

                        <section>
                            <div class="flex items-center space-x-2 mb-6">
                                <span class="text-indigo-600 font-bold text-lg">01</span>
                                <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">Informasi Produk
                                </h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="md:col-span-3">
                                    <label
                                        class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Nama
                                        Lengkap Produk</label>
                                    <input type="text" name="nama_product" value="{{ $product->nama_product }}"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                        placeholder="Contoh: Jaket Waterproof GORE-TEX">
                                </div>

                                <div class="md:col-span-1">
                                    <label
                                        class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Brand</label>
                                    <select name="id_brand"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 appearance-none font-medium cursor-pointer">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ $product->id_brand == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->nama_brand }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="md:col-span-1">
                                    <label
                                        class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Kategori</label>
                                    <select name="id_category"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 appearance-none font-medium cursor-pointer">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->id_category == $category->id ? 'selected' : '' }}>
                                                {{ $category->nama_category }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="md:col-span-3">
                                    <label
                                        class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Deskripsi
                                        Singkat</label>
                                    <textarea name="deskripsi" rows="4"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 font-medium">{{ $product->deskripsi }}</textarea>
                                </div>
                            </div>
                        </section>
                    </form>

                        {{-- 02 Variants Warna --}}
                        <section>
                            <div x-data="{ openVariant: false }" class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-2">
                                    <span class="text-indigo-600 font-bold text-lg">02</span>
                                    <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                                        Detail Varian & Spesifikasi
                                    </h2>
                                </div>
                                <button type="button" @click="openVariant = true"
                                    class="group inline-flex items-center justify-center px-6 py-3 text-[11px] font-black text-white bg-gradient-to-r from-indigo-600 to-violet-600 rounded-2xl hover:from-indigo-700 hover:to-violet-700 hover:shadow-xl hover:shadow-indigo-200 transition-all duration-300 uppercase tracking-[0.2em] active:scale-95">
                                    <svg class="w-4 h-4 mr-2 stroke-[3] group-hover:rotate-90 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15">
                                        </path>
                                    </svg>
                                    Tambah Varian Warna
                                </button>
                                {{-- Modal Tambah Varian Warna --}}
                                <div x-show="openVariant" x-cloak
                                    class="fixed inset-0 z-50 flex items-center justify-center p-4">
                                    <div class="fixed inset-0 bg-slate-900/40" @click="openVariant = false"></div>
                                    <div class="relative w-full max-w-md bg-white rounded-2xl p-6 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">Tambah Varian</h3>
                                        <form action="{{ route('admin.products.variants.store', $product) }}"
                                            method="POST">
                                            @csrf
                                            <label class="block text-xs font-bold mb-2">Warna</label>
                                            <select name="id_color" required
                                                class="w-full mb-4 bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-bold text-sm">
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->nama_warna }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            {{-- Tambah field lain yang dibutuhkan storeVariant --}}
                                            <div class="flex justify-end gap-2">
                                                <button type="button" @click="openVariant = false"
                                                    class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-slate-500 bg-white border border-slate-200 rounded-xl hover:bg-slate-100 transition-all duration-300 uppercase tracking-widest shadow-sm">
                                                    Batal
                                                </button>
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-white bg-indigo-600 border border-indigo-600 rounded-xl hover:bg-indigo-700 transition-all duration-200 uppercase tracking-widest shadow-sm">
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 p-6">
                                <div class="space-y-6">
                                    @foreach ($product->variants as $variant)
                                        <div x-data="{ openCreate: false }"
                                            class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden group hover:border-indigo-300 transition-all duration-300">

                                            <div
                                                class="bg-slate-50/80 px-6 py-3 border-b border-slate-100 flex items-center justify-between">
                                                <div class="flex items-center space-x-2">
                                                    <span
                                                        class="text-xs font-bold text-slate-500 uppercase tracking-widest">Warna:</span>
                                                    <span
                                                        class="text-sm font-black text-slate-800 uppercase tracking-wide">
                                                        {{ $variant->color->nama_warna ?? 'Tanpa Warna' }}
                                                    </span>
                                                </div>
                                                <button type="button" @click="openCreate = true"
                                                    class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-emerald-600 bg-white border border-emerald-100 rounded-xl hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all duration-300 uppercase tracking-widest shadow-sm">
                                                    Tambah Spesifikasi
                                                </button>
                                            </div>

                                            {{-- Modal tambah spesifikasi --}}
                                            <div x-show="openCreate" x-cloak
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0"
                                                x-transition:enter-end="opacity-100"
                                                x-transition:leave="transition ease-in duration-200"
                                                x-transition:leave-start="opacity-100"
                                                x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 z-50 overflow-y-auto">
                                                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"
                                                    @click="openCreate = false"></div>

                                                <div
                                                    class="relative min-h-screen flex items-center justify-center p-4">
                                                    <div @click.away="openCreate = false"
                                                        x-transition:enter="transition ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 scale-95"
                                                        x-transition:enter-end="opacity-100 scale-100"
                                                        class="relative w-full max-w-lg bg-white rounded-[2rem] shadow-2xl border border-white/20 overflow-hidden">

                                                        <div
                                                            class="glass-header px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                                                            <div>
                                                                <p
                                                                    class="text-[11px] font-bold text-slate-500 uppercase tracking-[0.25em] mb-1">
                                                                    Tambah Spesifikasi</p>
                                                                <h3 class="text-lg font-bold text-slate-800">Varian:
                                                                    {{ $variant->color->nama_warna ?? 'Tanpa Warna' }}
                                                                </h3>
                                                            </div>
                                                            <button type="button" @click="openCreate = false"
                                                                class="text-slate-400 hover:text-slate-600">
                                                                <svg class="w-6 h-6" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <form
                                                            action="{{ route('admin.products.variants.specs.store', [$product, $variant]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="p-8 space-y-6">
                                                                <div>
                                                                    <label
                                                                        class="block text-[11px] font-bold text-slate-500 uppercase mb-2 tracking-widest text-left">Ukuran</label>
                                                                    <select name="id_size" required
                                                                        class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-bold text-sm">
                                                                        <option value="" disabled selected>Pilih
                                                                            ukuran</option>
                                                                        @foreach ($sizes as $size)
                                                                            <option value="{{ $size->id }}">
                                                                                {{ $size->label_size }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div>
                                                                    <label
                                                                        class="block text-[11px] font-bold text-slate-500 uppercase mb-2 tracking-widest text-left">Kode
                                                                        SKU</label>
                                                                    <input type="text" name="sku" required
                                                                        maxlength="100"
                                                                        class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-mono text-sm uppercase"
                                                                        placeholder="SKU unik">
                                                                </div>

                                                                <div class="grid grid-cols-2 gap-4">
                                                                    <div>
                                                                        <label
                                                                            class="block text-[11px] font-bold text-slate-500 uppercase mb-2 tracking-widest text-left">Harga
                                                                            (Rp)</label>
                                                                        <input type="number" name="harga"
                                                                            min="0" step="100" required
                                                                            class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-bold text-sm">
                                                                    </div>
                                                                    <div>
                                                                        <label
                                                                            class="block text-[11px] font-bold text-slate-500 uppercase mb-2 tracking-widest text-left">Stok
                                                                            Unit</label>
                                                                        <input type="number" name="stok"
                                                                            min="0" step="1" required
                                                                            class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-bold text-sm text-indigo-600">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="bg-slate-50/80 px-8 py-6 flex items-center justify-end space-x-3">
                                                                <button type="button" @click="openCreate = false"
                                                                    class="text-xs font-bold text-slate-500 uppercase tracking-widest">Batal</button>
                                                                <button type="submit"
                                                                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-bold text-xs shadow-lg shadow-emerald-200 active:scale-95 transition-all">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-4">
                                                <table class="w-full text-left">
                                                    <thead>
                                                        <tr
                                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                            <th class="px-4 pb-2">Kode SKU</th>
                                                            <th class="px-4 pb-2">Harga Jual</th>
                                                            <th class="px-4 pb-2">Stok Tersedia</th>
                                                            <th class="px-4 pb-2 text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-slate-50">
                                                        @foreach ($variant->specs as $spec)
                                                            <tr>
                                                                <td class="px-4 py-3">
                                                                    <span
                                                                        class="font-mono text-sm font-bold text-slate-600 bg-slate-100 px-2 py-1 rounded-md uppercase">
                                                                        {{ $spec->sku }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-4 py-3">
                                                                    <span class="text-sm font-bold text-slate-800">
                                                                        Rp{{ number_format($spec->harga, 0, ',', '.') }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-4 py-3">
                                                                    <div class="flex items-center">
                                                                        <span
                                                                            class="text-sm font-black {{ $spec->stok > 10 ? 'text-indigo-600' : 'text-amber-500' }}">
                                                                            {{ $spec->stok }}
                                                                        </span>
                                                                        <span
                                                                            class="text-[10px] text-slate-400 ml-1 font-bold uppercase">Unit</span>
                                                                    </div>
                                                                </td>
                                                                <td class="px-4 py-3 text-right">
                                                                    <div class="flex items-center justify-end gap-3">
                                                                        <div x-data="{ isOpen: false }">
                                                                            <button type="button"
                                                                                @click="isOpen = true"
                                                                                class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-indigo-600 bg-white border border-indigo-100 rounded-xl hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition-all duration-300 uppercase tracking-widest shadow-sm">
                                                                                <svg class="w-3 h-3 mr-1.5"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2.5"
                                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                                    </path>
                                                                                </svg>
                                                                                Edit
                                                                            </button>

                                                                            {{-- Modal Form --}}
                                                                            <div x-show="isOpen" x-cloak
                                                                                x-transition:enter="transition ease-out duration-300"
                                                                                x-transition:enter-start="opacity-0"
                                                                                x-transition:enter-end="opacity-100"
                                                                                x-transition:leave="transition ease-in duration-200"
                                                                                x-transition:leave-start="opacity-100"
                                                                                x-transition:leave-end="opacity-0"
                                                                                class="fixed inset-0 z-50 overflow-y-auto">

                                                                                {{-- Backdrop --}}
                                                                                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"
                                                                                    @click="isOpen = false"></div>

                                                                                {{-- Modal Content --}}
                                                                                <div
                                                                                    class="relative min-h-screen flex items-center justify-center p-4">
                                                                                    <div @click.away="isOpen = false"
                                                                                        x-transition:enter="transition ease-out duration-300"
                                                                                        x-transition:enter-start="opacity-0 scale-90"
                                                                                        x-transition:enter-end="opacity-100 scale-100"
                                                                                        class="relative w-full max-w-md bg-white rounded-[2rem] shadow-2xl border border-white/20 overflow-hidden">

                                                                                        {{-- Header --}}
                                                                                        <div
                                                                                            class="glass-header px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                                                                                            <h3
                                                                                                class="text-lg font-bold text-slate-800">
                                                                                                Edit Spesifikasi</h3>

                                                                                            {{-- Close --}}
                                                                                            <button type="button"
                                                                                                @click="isOpen = false"
                                                                                                class="text-slate-400 hover:text-slate-600">
                                                                                                <svg class="w-6 h-6"
                                                                                                    fill="none"
                                                                                                    stroke="currentColor"
                                                                                                    viewBox="0 0 24 24">
                                                                                                    <path
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"
                                                                                                        stroke-width="2"
                                                                                                        d="M6 18L18 6M6 6l12 12">
                                                                                                    </path>
                                                                                                </svg>
                                                                                            </button>
                                                                                        </div>

                                                                                        {{-- Body --}}
                                                                                        <form
                                                                                            :action="'/admin/variant-specs/' +
                                                                                            specData.id"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <div class="p-8 space-y-6">
                                                                                                <div>
                                                                                                    <label
                                                                                                        class="block text-[11px] font-bold text-slate-500 uppercase mb-2 tracking-widest text-left">Kode
                                                                                                        SKU</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        name="sku"
                                                                                                        value="{{ $spec->sku }}"
                                                                                                        class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-mono text-sm uppercase">
                                                                                                    {{-- Footer --}}
                                                                                                    <div
                                                                                                        class="bg-slate-50/80 px-8 py-6 flex items-center justify-end space-x-3">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            @click="isOpen = false"
                                                                                                            class="text-xs font-bold text-slate-500 uppercase tracking-widest">Batal
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="submit"
                                                                                                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-bold text-xs shadow-lg shadow-indigo-200 active:scale-95 transition-all">
                                                                                                            Simpan
                                                                                                            Perubahan
                                                                                                        </button>
                                                                                                    </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div x-data="{ openDelete: false }">
                                                                            <button type="button"
                                                                                @click="openDelete = true"
                                                                                class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-red-500 bg-white border border-red-100 rounded-xl hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-300 uppercase tracking-widest shadow-sm">
                                                                                <svg class="w-3 h-3 mr-1.5"
                                                                                    fill="none"
                                                                                    stroke="currentColor"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        stroke-width="2.5"
                                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                                    </path>
                                                                                </svg>
                                                                                Hapus Spesifikasi
                                                                            </button>

                                                                            <div x-show="openDelete" x-cloak
                                                                                x-transition:enter="transition ease-out duration-200"
                                                                                x-transition:enter-start="opacity-0"
                                                                                x-transition:enter-end="opacity-100"
                                                                                x-transition:leave="transition ease-in duration-150"
                                                                                x-transition:leave-start="opacity-100"
                                                                                x-transition:leave-end="opacity-0"
                                                                                class="fixed inset-0 z-50 flex items-center justify-center p-4">
                                                                                <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
                                                                                    @click="openDelete = false"></div>
                                                                                <div
                                                                                    class="relative w-full max-w-sm bg-white rounded-2xl shadow-2xl border border-slate-100 p-6 space-y-4">
                                                                                    <div
                                                                                        class="flex items-start space-x-3">
                                                                                        <div
                                                                                            class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-black text-lg">
                                                                                            !</div>
                                                                                        <div>
                                                                                            <h4
                                                                                                class="text-lg font-bold text-slate-800">
                                                                                                Hapus spesifikasi?</h4>
                                                                                            <p
                                                                                                class="text-sm text-slate-500">
                                                                                                Yakin ingin menghapus
                                                                                                spesifikasi ini</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="flex items-center justify-end gap-3 pt-2">
                                                                                        <button type="button"
                                                                                            @click="openDelete = false"
                                                                                            class="text-xs font-bold text-slate-500 uppercase tracking-widest">Batal</button>
                                                                                        <form x-ref="deleteForm"
                                                                                            action="{{ route('admin.products.variants.specs.destroy', [$product, $variant, $spec]) }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button type="submit"
                                                                                                class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-white bg-red-600 border border-red-600 rounded-xl hover:bg-red-700 hover:border-red-700 transition-all duration-200 uppercase tracking-widest shadow-sm">
                                                                                                Hapus
                                                                                            </button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="bg-slate-50/80 px-8 py-6 flex items-center justify-between border-t border-slate-100">
                        <button type="button" onclick="window.history.back();"
                            class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </button>

                        <div class="flex items-center space-x-4">
                            <button type="submit" form="product-update-form"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-xl shadow-indigo-200 transition-all active:scale-95">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
            </div>

            <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
                &copy; 2025 Praktikum Web &bull; Management System
            </p>
        </div>
    </div>


</body>

</html>
