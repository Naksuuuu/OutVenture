<div class="py-12 px-4 sm:px-6">
    <div class=" mx-auto">
        <div
            class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-100 overflow-hidden">

            <div class="px-8 py-10 bg-slate-50/50 border-b border-slate-100">
                <div class="flex items-center space-x-5">
                    <div
                        class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center shadow-xl shadow-slate-200">
                        <x-lucide-plus-circle class="w-7 h-7 text-white" />
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight text-slate-900 uppercase italic">Tambah Brand</h1>
                        <p class="text-slate-500 font-medium mt-1">Daftarkan mitra brand baru ke dalam sistem katalog.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <form wire:submit.prevent="save" class="space-y-8">

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Nama
                            Brand</label>
                        <input wire:model="nama_brand" type="text" placeholder="Masukkan nama brand..."
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
                                <span class="text-xs text-slate-400 font-medium italic">Berikan lencana verifikasi pada
                                    brand ini.</span>
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Brand
                                Logo (1:1)</label>
                            <div class="relative group">
                                <input wire:model="logo" type="file"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="border-2 border-dashed border-slate-200 rounded-[2rem] p-8 flex flex-col items-center justify-center bg-slate-50/50 group-hover:bg-emerald-50/30 group-hover:border-emerald-200 transition-all">
                                    @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}"
                                            class="w-24 h-24 object-contain rounded-xl shadow-md">
                                    @else
                                        <x-lucide-box class="w-8 h-8 text-slate-300 mb-2" />
                                        <span class="text-[10px] font-black text-slate-400 uppercase italic">Pilih
                                            Logo</span>
                                    @endif
                                </div>
                            </div>
                            @error('logo')
                                <span
                                    class="text-red-500 text-[10px] font-black uppercase tracking-wider block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-3">
                            <label
                                class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Thumbnail
                                Image</label>
                            <div class="relative group">
                                <input wire:model="image" type="file"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="border-2 border-dashed border-slate-200 rounded-[2rem] p-8 flex flex-col items-center justify-center bg-slate-50/50 group-hover:bg-emerald-50/30 group-hover:border-emerald-200 transition-all">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}"
                                            class="w-24 h-24 object-cover rounded-xl shadow-md">
                                    @else
                                        <x-lucide-image class="w-8 h-8 text-slate-300 mb-2" />
                                        <span class="text-[10px] font-black text-slate-400 uppercase italic">Pilih
                                            Thumbnail</span>
                                    @endif
                                </div>
                            </div>
                            @error('image')
                                <span
                                    class="text-red-500 text-[10px] font-black uppercase tracking-wider block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md:col-span-2 space-y-3">
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Wide
                                Banner (Hero)</label>
                            <div class="relative group">
                                <input wire:model="wide_image" type="file"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="border-2 border-dashed border-slate-200 rounded-[2rem] p-10 flex flex-col items-center justify-center bg-slate-50/50 group-hover:bg-emerald-50/30 group-hover:border-emerald-200 transition-all">
                                    @if ($wide_image)
                                        <img src="{{ $wide_image->temporaryUrl() }}"
                                            class="w-full h-32 object-cover rounded-[1.5rem] shadow-sm">
                                    @else
                                        <x-lucide-layout-panel-top class="w-10 h-10 text-slate-300 mb-2" />
                                        <span
                                            class="text-[10px] font-black text-slate-400 uppercase italic text-center">Pilih
                                            Banner Utama<br>(Wide Format)</span>
                                    @endif
                                </div>
                            </div>
                            @error('wide_image')
                                <span
                                    class="text-red-500 text-[10px] font-black uppercase tracking-wider block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div wire:loading class="w-full">
                        <div
                            class="flex items-center justify-center p-4 bg-emerald-50 rounded-2xl animate-pulse border border-emerald-100">
                            <span class="text-emerald-600 text-[10px] font-black uppercase tracking-widest">Aset sedang
                                diproses...</span>
                        </div>
                    </div>

                    <div
                        class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <a href="{{ route('admin.brands.index') }}" wire:navigate
                            class="flex items-center gap-2 text-slate-400 hover:text-slate-900 font-black text-[10px] uppercase tracking-[0.2em] transition-all group">
                            <x-lucide-arrow-left class="w-4 h-4 group-hover:-translate-x-1 transition-transform" />
                            Kembali ke Daftar
                        </a>

                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full sm:w-auto bg-slate-900 hover:bg-emerald-600 text-white px-12 py-5 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-slate-200 transition-all active:scale-95 flex items-center justify-center gap-3">
                            Simpan Brand
                            <x-lucide-check-circle class="w-4 h-4" />
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
