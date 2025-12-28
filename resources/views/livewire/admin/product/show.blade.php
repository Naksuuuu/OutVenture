<div class="">
    <div class="mx-auto">

        <div
            class="bg-white rounded-3xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden">

            <div
                class="glass-header px-8 py-8 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-black rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h18M6 12h12M10 17h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-800">Detail Produk</h1>
                        <p class="text-sm text-slate-500 mt-1">{{ $product->nama_product }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-10">

                <section>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-2 space-y-3">
                            <p class="text-[13px] font-bold text-slate-600 uppercase tracking-wider">Deskripsi</p>
                            <div class="bg-slate-50 rounded-2xl px-5 py-4 text-slate-800 shadow-inner">
                                {{ $product->deskripsi ?? 'Tidak ada deskripsi.' }}
                            </div>
                        </div>
                        <div class="space-y-3">
                            <p class="text-[13px] font-bold text-slate-600 uppercase tracking-wider">Informasi</p>
                            <div class="bg-slate-50 rounded-2xl px-5 py-4 text-slate-800 shadow-inner space-y-2">
                                <div class="flex items-center justify-between"><span
                                        class="text-slate-500 text-sm">Kategori</span><span
                                        class="font-medium text-sm">{{ $product->category->nama_category ?? '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between"><span
                                        class="text-slate-500 text-sm">Brand</span><span
                                        class="font-medium text-sm">{{ $product->brand->nama_brand ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-indigo-600 font-bold text-lg">01</span>
                        <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">Varian</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($product->variants as $variant)
                            <div class="rounded-2xl border border-slate-200 shadow-sm overflow-hidden bg-white">
                                <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                                    <span
                                        class="text-[12px] font-bold text-slate-600 uppercase tracking-wider">Warna</span>
                                    <span
                                        class="text-sm font-medium">{{ $variant->color->nama_warna ?? 'Tidak ada' }}</span>
                                </div>
                                <div class="p-4 space-y-4">
                                    <div>
                                        @if ($variant->image)
                                            <img src="{{ asset('storage/' . $variant->image) }}"
                                                alt="{{ $product->nama_product }}"
                                                class="w-full rounded-xl object-cover">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor"
                                                class="w-full h-40 bg-slate-50 rounded-xl text-slate-300">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        @endif
                                    </div>

                                    <div class="space-y-3">
                                        <p class="text-[13px] font-bold text-slate-600 uppercase tracking-wider">
                                            Spesifikasi</p>
                                        <div class="space-y-2">
                                            @forelse ($variant->specs as $spec)
                                                <div
                                                    class="flex items-center justify-between bg-slate-50 rounded-xl px-4 py-3">
                                                    <div class="flex items-center gap-4">
                                                        <span
                                                            class="text-sm font-medium">{{ $spec->size->label_size ?? '-' }}</span>
                                                        <span class="text-xs text-slate-500">SKU:
                                                            {{ $spec->sku }}</span>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-sm font-bold">Rp
                                                            {{ number_format($spec->harga, 0, ',', '.') }}</div>
                                                        <div class="text-[11px] text-slate-500">Stok:
                                                            {{ $spec->stok }}</div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-sm text-slate-500">Belum ada spesifikasi.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="md:col-span-3 text-sm text-slate-500">Belum ada varian.</div>
                        @endforelse
                    </div>
                </section>
            </div>

            <div class="bg-slate-50/80 px-8 py-6 flex items-center border-t border-slate-100">
                <a href="{{ route('admin.products.index') }}" wire:navigate
                    class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
            &copy; 2025 Praktikum Web &bull; Management System
        </p>
    </div>
</div>
