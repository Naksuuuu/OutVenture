<div x-data="{ openCreate: @entangle('isOpen').live }">

    <button type="button" @click="openCreate = true"
        class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-emerald-600 bg-white border border-emerald-100 rounded-xl hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all duration-300 uppercase tracking-widest shadow-sm">
        Tambah Spesifikasi
    </button>

    <div x-show="openCreate" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto">

        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" @click="openCreate = false"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div @click.away="openCreate = false" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="relative w-full max-w-lg bg-white rounded-[2rem] shadow-2xl border border-white/20 overflow-hidden">

                <div class="glass-header px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-[0.25em] mb-1">
                            Tambah Spesifikasi</p>
                        <h3 class="text-lg font-bold text-slate-800">
                            Varian:
                            {{ $variant->color->nama_warna ?? 'Tanpa Warna' }}
                        </h3>
                    </div>
                    <button type="button" @click="openCreate = false" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="save">
                    <div class="p-8 space-y-6">
                        <div>
                            <label
                                class="block text-[11px] font-bold text-slate-500 uppercase mb-2 tracking-widest text-left">Ukuran</label>
                            <select wire:model="id_size_value"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-bold text-sm @error('id_size_value') ring-2 ring-red-500/50 @enderror">
                                <option value="" selected>Pilih ukuran</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->label_size }}</option>
                                @endforeach
                            </select>
                            @error('id_size_value')
                                <span class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[11px] font-bold text-slate-500 uppercase mb-2 tracking-widest text-left">Kode
                                SKU</label>
                            <input type="text" wire:model="sku" maxlength="100"
                                class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-mono text-sm uppercase @error('sku') ring-2 ring-red-500/50 @enderror"
                                placeholder="SKU unik">
                            @error('sku')
                                <span class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase mb-2 tracking-widest text-left">Harga
                                    (Rp)</label>
                                <input type="number" wire:model="harga" min="0" step="100"
                                    class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-bold text-sm @error('harga') ring-2 ring-red-500/50 @enderror">
                                @error('harga')
                                    <span class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase mb-2 tracking-widest text-left">Stok
                                    Unit</label>
                                <input type="number" wire:model="stok" min="0" step="1"
                                    class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-bold text-sm text-indigo-600 @error('stok') ring-2 ring-red-500/50 @enderror">
                                @error('stok')
                                    <span class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50/80 px-8 py-6 flex items-center justify-end space-x-3">
                        <button type="button" @click="openCreate = false"
                            class="text-xs font-bold text-slate-500 uppercase tracking-widest">Batal</button>

                        <button type="submit" wire:loading.attr="disabled"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-bold text-xs shadow-lg shadow-emerald-200 active:scale-95 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">Memproses...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
