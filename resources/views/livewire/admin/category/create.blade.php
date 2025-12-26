<div class="py-12 px-4 sm:px-6 bg-slate-50/50 min-h-screen">
    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

            <div class="px-10 py-10 border-b border-slate-50 bg-slate-900 text-white relative">
                <div class="relative z-10 flex items-center gap-6">
                    <div
                        class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20 rotate-3 transition-transform hover:rotate-0">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Tambah Kategori</h1>
                        <p class="text-slate-400 font-medium mt-1">Lengkapi formulir di bawah untuk memperluas katalog
                            OutVenture.</p>
                    </div>
                </div>
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z"></path>
                    </svg>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <form wire:submit.prevent="save" class="space-y-10">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm text-sans">01</span>
                                <h2 class="font-black text-slate-800 uppercase tracking-widest text-xs">Informasi Dasar
                                </h2>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em] group-focus-within:text-emerald-500 transition-colors">
                                    Nama Kategori
                                </label>
                                <input wire:model.live="nama_category" type="text"
                                    placeholder="Contoh: Tenda Camping"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-emerald-500 transition-all font-bold placeholder:text-slate-300">
                                @error('nama_category')
                                    <span
                                        class="text-rose-500 text-[10px] mt-2 font-black uppercase block tracking-tight">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="group">
                                <label
                                    class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em] group-focus-within:text-emerald-500 transition-colors">
                                    Kelompok Ukuran
                                </label>
                                <div class="space-y-3">
                                    <div class="relative">
                                        <select wire:model="id_size_group"
                                            class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-emerald-500 transition-all font-bold cursor-pointer appearance-none">
                                            <option value="">Pilih Size Group</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}" @selected($id_size_group == $size->id)>
                                                    {{ $size->nama_group }}</option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                @error('id_size_group')
                                    <span
                                        class="text-rose-500 text-[10px] mt-2 font-black uppercase block tracking-tight">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm text-sans">02</span>
                                <h2 class="font-black text-slate-800 uppercase tracking-widest text-xs">Visual Kategori
                                </h2>
                            </div>

                            <div class="relative group">
                                <label
                                    class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em]">Upload
                                    Foto</label>
                                <div
                                    class="aspect-square rounded-[2.5rem] bg-slate-50 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center overflow-hidden transition-all group-hover:border-emerald-400 relative">

                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                        <div
                                            class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <p class="text-white font-black text-xs uppercase tracking-widest">Ganti
                                                Gambar</p>
                                        </div>
                                    @else
                                        <div class="flex flex-col items-center p-6 text-center">
                                            <svg class="w-12 h-12 text-slate-200 mb-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">
                                                Seret file atau klik untuk memilih</p>
                                        </div>
                                    @endif

                                    <input type="file" wire:model="image"
                                        class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>

                                <div wire:loading wire:target="image"
                                    class="absolute inset-0 bg-white/90 flex flex-col items-center justify-center rounded-[2.5rem] z-20">
                                    <div
                                        class="w-8 h-8 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin">
                                    </div>
                                    <p class="mt-4 text-[10px] font-black text-emerald-600 uppercase animate-pulse">
                                        Sedang Mengunggah...</p>
                                </div>
                            </div>
                            @error('image')
                                <span
                                    class="text-rose-500 text-[10px] font-black uppercase block mt-2 tracking-tight">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-10 border-t border-slate-50"
                        wire:loading.attr="disabled">
                        <a href="{{ route('admin.categories.index') }}" wire:navigate
                            class="text-slate-400 hover:text-slate-900 text-[11px] font-black uppercase tracking-[0.2em] transition-colors flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>

                        <button type="submit"
                            class="bg-emerald-600 hover:bg-slate-900 text-white px-10 py-5 rounded-2xl font-black text-xs shadow-xl shadow-emerald-100 transition-all active:scale-95 uppercase italic tracking-widest">
                            Simpan Kategori Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-[10px] font-black tracking-widest uppercase italic">
            &copy; 2025 OutVenture &bull; Katalog Management System
        </p>
    </div>
</div>
