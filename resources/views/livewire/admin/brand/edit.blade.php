<div class="py-12 px-4 sm:px-6">
    <div class="mx-auto">
        <div
            class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-100 overflow-hidden">

            <div class="px-8 py-10 bg-slate-50/50 border-b border-slate-100">
                <div class="flex items-center space-x-5">
                    <div
                        class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center shadow-xl shadow-slate-200">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight text-slate-900 uppercase italic">Edit Brand</h1>
                        <p class="text-emerald-600 font-bold mt-1 uppercase text-xs tracking-widest">
                            {{ $brand->nama_brand }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <form wire:submit.prevent="update" class="space-y-8">

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Nama
                            Brand</label>
                        <input wire:model="nama_brand" type="text"
                            class="w-full bg-slate-50 border-2 border-transparent rounded-2xl px-6 py-4 text-slate-800 focus:border-emerald-500/20 focus:bg-white focus:ring-0 transition-all duration-300 placeholder:text-slate-300 font-bold shadow-sm shadow-inner">
                        @error('nama_brand')
                            <span
                                class="text-red-500 text-[10px] mt-2 font-black uppercase tracking-wider block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <label
                            class="relative flex items-center p-5 bg-slate-50 rounded-3xl cursor-pointer hover:bg-slate-100 transition-all border border-transparent hover:border-emerald-100 group">
                            <input wire:model="is_trusted" type="checkbox"
                                class="w-6 h-6 text-emerald-600 bg-white border-slate-200 rounded-lg focus:ring-offset-0 focus:ring-transparent transition-all">
                            <div class="ml-4">
                                <span class="block text-sm font-black text-slate-700 uppercase tracking-tight">Set
                                    sebagai Trusted Brand</span>
                                <span class="text-xs text-slate-400 font-medium italic">Status verifikasi brand saat
                                    ini.</span>
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <div class="space-y-4">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Brand
                                Logo</label>
                            <div class="flex flex-col gap-4">
                                <div class="relative group">
                                    <input wire:model="new_logo" type="file"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div
                                        class="border-2 border-dashed border-slate-200 rounded-[2rem] p-6 flex flex-col items-center justify-center bg-slate-50/50 group-hover:bg-emerald-50/30 group-hover:border-emerald-200 transition-all">
                                        <span class="text-[10px] font-black text-slate-400 uppercase italic">Klik untuk
                                            ganti logo</span>
                                    </div>
                                </div>
                                <div class="p-4 bg-slate-50 rounded-3xl border border-slate-100">
                                    <p class="text-[9px] font-black text-slate-400 uppercase mb-2 tracking-wider">
                                        Preview:</p>
                                    @if ($new_logo)
                                        <img src="{{ $new_logo->temporaryUrl() }}"
                                            class="w-full h-32 object-contain rounded-xl">
                                    @elseif($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}"
                                            class="w-full h-32 object-contain rounded-xl">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label
                                class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Thumbnail
                                Image</label>
                            <div class="flex flex-col gap-4">
                                <div class="relative group">
                                    <input wire:model="new_image" type="file"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div
                                        class="border-2 border-dashed border-slate-200 rounded-[2rem] p-6 flex flex-col items-center justify-center bg-slate-50/50 group-hover:bg-emerald-50/30 group-hover:border-emerald-200 transition-all">
                                        <span class="text-[10px] font-black text-slate-400 uppercase italic">Klik untuk
                                            ganti thumbnail</span>
                                    </div>
                                </div>
                                <div class="p-4 bg-slate-50 rounded-3xl border border-slate-100">
                                    <p class="text-[9px] font-black text-slate-400 uppercase mb-2 tracking-wider">
                                        Preview:</p>
                                    @if ($new_image)
                                        <img src="{{ $new_image->temporaryUrl() }}"
                                            class="w-full h-32 object-cover rounded-xl">
                                    @elseif($brand->image)
                                        <img src="{{ asset('storage/' . $brand->image) }}"
                                            class="w-full h-32 object-cover rounded-xl">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2 space-y-4">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Wide
                                Banner (Hero)</label>
                            <div class="relative group mb-4">
                                <input wire:model="new_wide_image" type="file"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="border-2 border-dashed border-slate-200 rounded-[2rem] p-6 flex flex-col items-center justify-center bg-slate-50/50 group-hover:bg-emerald-50/30 group-hover:border-emerald-200 transition-all">
                                    <span class="text-[10px] font-black text-slate-400 uppercase italic">Pilih Banner
                                        Baru untuk Mengubah</span>
                                </div>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-[2rem] border border-slate-100">
                                <p
                                    class="text-[9px] font-black text-slate-400 uppercase mb-3 tracking-wider text-center">
                                    Current / New Banner View:</p>
                                @if ($new_wide_image)
                                    <img src="{{ $new_wide_image->temporaryUrl() }}"
                                        class="w-full h-48 object-cover rounded-[1.5rem] shadow-sm">
                                @elseif($brand->wide_image)
                                    <img src="{{ asset('storage/' . $brand->wide_image) }}"
                                        class="w-full h-48 object-cover rounded-[1.5rem] shadow-sm">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div wire:loading class="w-full">
                        <div
                            class="flex items-center justify-center p-4 bg-emerald-50 rounded-2xl animate-pulse border border-emerald-100">
                            <span class="text-emerald-600 text-[10px] font-black uppercase tracking-widest">Memproses
                                unggahan...</span>
                        </div>
                    </div>

                    <div
                        class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <a href="{{ route('admin.brands.index') }}" wire:navigate
                            class="flex items-center gap-2 text-slate-400 hover:text-slate-900 font-black text-[10px] uppercase tracking-[0.2em] transition-all group">
                            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Daftar
                        </a>

                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full sm:w-auto bg-slate-900 hover:bg-emerald-600 text-white px-12 py-5 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-slate-200 transition-all active:scale-95 flex items-center justify-center gap-3">
                            Simpan Perubahan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-[10px] font-black tracking-[0.3em] uppercase opacity-50">
            &copy; 2025 OutVenture Management System
        </p>
    </div>
</div>
