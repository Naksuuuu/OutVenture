<div class="">
    <div class="mx-auto">

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

            <div class="px-10 py-10 border-b border-slate-50 bg-white relative">
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div
                            class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg rotate-3 transition-transform hover:rotate-0">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-black tracking-tight text-slate-800 uppercase italic">Detail
                                Kategori</h1>
                            <p class="text-emerald-500 font-bold mt-1 tracking-wider uppercase text-xs">Informasi
                                Lengkap Produk</p>
                        </div>
                    </div>

                    <div class="hidden md:block">
                        <span
                            class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                            Status: Terverifikasi
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">

                    <div class="space-y-8">
                        <div class="flex items-center gap-3 mb-2">
                            <span
                                class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-black text-sm">01</span>
                            <h2 class="font-black text-slate-800 uppercase tracking-widest text-xs">Data Identitas</h2>
                        </div>

                        <div class="space-y-8">
                            <div class="group">
                                <label
                                    class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Nama
                                    Kategori</label>
                                <div
                                    class="bg-slate-50 px-8 py-6 rounded-[2rem] border border-slate-100 transition-all hover:bg-white hover:shadow-md">
                                    <p class="text-xl font-bold text-slate-800 leading-tight">
                                        {{ $category->nama_category }}
                                    </p>
                                </div>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Format
                                    Ukuran</label>
                                <div
                                    class="flex items-center gap-4 bg-slate-50 px-8 py-6 rounded-[2rem] border border-slate-100 transition-all hover:bg-white hover:shadow-md">
                                    <div
                                        class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]">
                                    </div>
                                    <p class="text-lg font-bold text-slate-700">
                                        {{ $category->sizeGroup->nama_group }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-center gap-3 mb-2">
                            <span
                                class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-black text-sm">02</span>
                            <h2 class="font-black text-slate-800 uppercase tracking-widest text-xs">Preview Visual</h2>
                        </div>

                        <div class="relative group">
                            <div
                                class="aspect-square w-full max-w-[350px] mx-auto rounded-[3.5rem] overflow-hidden bg-slate-100 border-8 border-white shadow-2xl relative z-10 transition-all duration-500 group-hover:scale-[1.02] group-hover:-rotate-1 flex items-center justify-center">
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                        class="w-full h-full object-cover" alt="{{ $category->nama_category }}">
                                @else
                                    <div
                                        class="flex flex-col items-center justify-center text-slate-300 p-10 text-center">
                                        <svg class="w-20 h-20 mb-4 opacity-20" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p
                                            class="text-[10px] font-black uppercase tracking-widest opacity-40 leading-relaxed">
                                            Gambar Tidak<br>Tersedia</p>
                                    </div>
                                @endif
                            </div>

                            <div
                                class="absolute -bottom-6 -right-6 w-full h-full max-w-[350px] mx-auto bg-emerald-500/10 rounded-[3.5rem] -rotate-6 z-0 transition-transform group-hover:rotate-0 group-hover:scale-105 duration-500 left-0 right-0">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-20 pt-10 border-t border-slate-50">
                    <x-ui.back-link href="{{ route('admin.categories.index') }}" wire:navigate />

                </div>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-[10px] font-black tracking-widest uppercase italic">
            &copy; 2025 OutVenture &bull; Management System
        </p>
    </div>
</div>
