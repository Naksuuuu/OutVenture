<div class="">
    <div class="mx-auto">

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

            <div class="px-10 py-10 border-b border-slate-50 bg-slate-900 text-white relative">
                <div class="relative z-10 flex items-center gap-6">
                    <div
                        class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20 rotate-3 transition-transform hover:rotate-0">
                        <x-lucide-square-pen />
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Edit Kategori</h1>
                        <p class="text-emerald-400 font-bold mt-1 tracking-wider uppercase text-xs">
                            {{ $category->nama_category }}</p>
                    </div>
                </div>
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <form wire:submit.prevent="update" class="space-y-10">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">01</span>
                                <h2 class="font-black text-slate-800 uppercase tracking-widest text-xs">Informasi Dasar
                                </h2>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em] group-focus-within:text-emerald-500 transition-colors">
                                    Nama Kategori
                                </label>
                                <input wire:model="nama_category" type="text"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-emerald-500 transition-all font-bold">
                                @error('nama_category')
                                    <span
                                        class="text-rose-500 text-[10px] mt-2 font-black uppercase block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="group">
                                <label
                                    class="block text-[11px] font-black text-slate-400 uppercase mb-3 tracking-[0.2em] group-focus-within:text-emerald-500 transition-colors">
                                    Kelompok Ukuran
                                </label>
                                <div class="relative">
                                    <select wire:model="id_size_group"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-emerald-500 transition-all font-bold cursor-pointer appearance-none">
                                        <option value="">Pilih Size Group</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}"
                                                {{ $category->id_size_group == $size->id ? 'selected' : '' }}>
                                                {{ $size->nama_group }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('id_size_group')
                                    <span
                                        class="text-rose-500 text-[10px] mt-2 font-black uppercase block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">02</span>
                                <h2 class="font-black text-slate-800 uppercase tracking-widest text-xs">Visual Kategori
                                </h2>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase mb-2 tracking-widest">
                                        Gambar Saat Ini</p>
                                    <div
                                        class="aspect-square rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner flex items-center justify-center group relative">
                                        @if ($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                class="w-full h-full object-cover opacity-60">
                                        @else
                                            <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                </div>

                                <div class="relative group">
                                    <p class="text-[9px] font-black text-emerald-600 uppercase mb-2 tracking-widest">
                                        Upload Baru</p>
                                    <div
                                        class="aspect-square rounded-2xl overflow-hidden bg-emerald-50 border-2 border-dashed border-emerald-200 flex items-center justify-center transition-all group-hover:border-emerald-400 relative">
                                        @if ($new_image)
                                            <img src="{{ $new_image->temporaryUrl() }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="text-center p-2">
                                                <svg class="w-8 h-8 text-emerald-300 mx-auto mb-1" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                                <span
                                                    class="text-[8px] font-black text-emerald-400 uppercase tracking-tighter">Pilih
                                                    File</span>
                                            </div>
                                        @endif
                                        <input type="file" wire:model="new_image"
                                            class="absolute inset-0 opacity-0 cursor-pointer">
                                    </div>
                                    @error('new_image')
                                        <span
                                            class="text-rose-500 text-[10px] mt-1 font-black uppercase block leading-tight">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div wire:loading wire:target="new_image"
                                class="flex items-center gap-2 text-[10px] font-black text-emerald-600 uppercase animate-pulse">
                                <div
                                    class="w-3 h-3 border-2 border-emerald-600 border-t-transparent rounded-full animate-spin">
                                </div>
                                Sedang mengunggah file...
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-10 border-t border-slate-50">
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
                            class="bg-slate-900 hover:bg-emerald-600 text-white px-10 py-5 rounded-2xl font-black text-xs shadow-xl transition-all active:scale-95 uppercase italic tracking-widest">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-[10px] font-black tracking-widest uppercase italic">
            &copy; 2025 OutVenture &bull; Management System
        </p>
    </div>
</div>
