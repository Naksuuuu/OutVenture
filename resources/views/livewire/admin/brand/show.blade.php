<div class="">
    <div class=" mx-auto">
        <div
            class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-100 overflow-hidden">

            <div class="px-8 py-10 bg-slate-50/50 border-b border-slate-100">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center space-x-5">
                        <div
                            class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center shadow-xl shadow-slate-200">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-black tracking-tight text-slate-900 uppercase italic">Detail Brand
                            </h1>
                            <p class="text-slate-500 font-bold mt-1 uppercase text-xs tracking-widest">Viewing record
                                ID: #{{ $brand->id }}</p>
                        </div>
                    </div>

                    <div>
                        @if ($brand->is_trusted)
                            <span
                                class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest border border-emerald-100 shadow-sm">
                                <x-lucide-badge-check class="w-4 h-4" />
                                Trusted Brand
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-2 bg-slate-100 text-slate-600 px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest border border-slate-200 shadow-sm">
                                <x-lucide-circle class="w-4 h-4" />
                                Regular Brand
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <div class="space-y-12">

                    <div class="relative">
                        <label class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Nama
                            Brand</label>
                        <div class="bg-slate-50 rounded-2xl px-8 py-6 border border-slate-100 shadow-inner">
                            <h2 class="text-2xl md:text-4xl font-black text-slate-800 italic uppercase tracking-tight">
                                {{ $brand->nama_brand }}
                            </h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <div class="space-y-4">
                            <label
                                class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Official
                                Logo</label>
                            <div
                                class="aspect-square bg-slate-50 rounded-[2rem] border border-slate-100 flex items-center justify-center p-8 shadow-sm group hover:bg-white transition-all duration-500">
                                @if ($brand->logo)
                                    <img src="{{ asset('storage/' . $brand->logo) }}"
                                        class="max-w-full max-h-full object-contain filter drop-shadow-md group-hover:scale-110 transition-transform duration-500"
                                        alt="Logo {{ $brand->nama_brand }}">
                                @else
                                    <div class="text-center">
                                        <x-lucide-image class="w-12 h-12 text-slate-200 mx-auto mb-2" />
                                        <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">No
                                            Logo</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Brand
                                Thumbnail</label>
                            <div
                                class="aspect-square bg-slate-50 rounded-[2rem] border border-slate-100 overflow-hidden shadow-sm group">
                                @if ($brand->image)
                                    <img src="{{ asset('storage/' . $brand->image) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        alt="Thumbnail {{ $brand->nama_brand }}">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <x-lucide-image-off class="w-12 h-12 text-slate-200" />
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-4">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Wide
                                Banner Image</label>
                            <div
                                class="relative h-64 bg-slate-50 rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm">
                                @if ($brand->wide_image)
                                    <img src="{{ asset('storage/' . $brand->wide_image) }}"
                                        class="w-full h-full object-cover" alt="Wide Banner {{ $brand->nama_brand }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                @else
                                    <div class="flex flex-col items-center justify-center h-full">
                                        <x-lucide-layout-panel-top class="w-12 h-12 text-slate-200 mb-2" />
                                        <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">No
                                            Banner Image</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-slate-100 flex justify-center">
                        <a href="{{ route('admin.brands.index') }}" wire:navigate
                            class="flex items-center gap-3 bg-slate-900 hover:bg-slate-800 text-white px-10 py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-slate-200 transition-all active:scale-95 group">
                            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Daftar Brand
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-[10px] font-black tracking-[0.3em] uppercase opacity-50">
            &copy; 2025 OutVenture Management System
        </p>
    </div>
</div>
