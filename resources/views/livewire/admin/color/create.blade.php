<div class="py-12 px-4 sm:px-6">
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
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                            Tambah Warna Baru</h1>
                        <p class="text-sm text-slate-500 mt-1">Buat warna produk baru</p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-10">

                <form wire:submit.prevent="save">
                    <section>
                        <div class="flex items-center space-x-2 mb-6">
                            <span class="text-indigo-600 font-bold text-lg">01</span>
                            <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                                Informasi Warna
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="md:col-span-2">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Nama
                                    Warna
                                </label>
                                <input wire:model.live="nama_warna" type="text" placeholder="Contoh: Merah, Biru, Hijau"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium">
                                @error('nama_warna')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Preview
                                    Warna
                                </label>
                                <div class="flex items-center gap-4 bg-slate-50 rounded-2xl px-5 py-4 shadow-inner">
                                    @php
                                        $colorMap = [
                                            'merah' => '#DC2626',
                                            'biru' => '#2563EB',
                                            'hijau' => '#16A34A',
                                            'kuning' => '#EAB308',
                                            'orange' => '#F97316',
                                            'ungu' => '#9333EA',
                                            'pink' => '#EC4899',
                                            'coklat' => '#92400E',
                                            'hitam' => '#000000',
                                            'putih' => '#FFFFFF',
                                            'abu-abu' => '#6B7280',
                                            'abu' => '#6B7280',
                                            'silver' => '#C0C0C0',
                                            'gold' => '#FFD700',
                                            'navy' => '#000080',
                                            'maroon' => '#800000',
                                            'tosca' => '#40E0D0',
                                            'cream' => '#FFFDD0',
                                        ];
                                        $key = strtolower(trim($nama_warna ?? ''));
                                        $colorHex = $colorMap[$key] ?? strtolower($nama_warna ?? '#cccccc');
                                    @endphp
                                    <div class="w-16 h-16 rounded-full border-4 border-white shadow-lg"
                                        style="background-color: {{ $colorHex }};">
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">{{ $nama_warna ?: 'Nama warna' }}</p>
                                        <p class="text-xs text-slate-500">{{ $colorHex }}</p>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-500 mt-2">
                                    <span class="font-bold">Warna yang didukung:</span> Merah, Biru, Hijau, Kuning, Orange, Ungu, Pink, Coklat, Hitam, Putih, Abu-abu, Silver, Gold, Navy, Maroon, Tosca, Cream
                                </p>
                            </div>
                        </div>
                    </section>

                    <div class="flex items-center justify-end px-8 py-6 mt-8">
                        <button type="submit"
                            class="bg-black/80 cursor-pointer hover:bg-black text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-xl shadow-indigo-200 transition-all active:scale-95">
                            Simpan Warna
                        </button>
                    </div>
                </form>

            </div>

            <div class="bg-slate-50/80 px-8 py-6 flex items-center border-t border-slate-100">
                <a href="{{ route('admin.colors.index') }}" wire:navigate
                    class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
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
