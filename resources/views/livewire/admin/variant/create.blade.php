<div x-data="{ open: @entangle('isOpen') }">
    <button type="button" @click="open = true"
        class="group inline-flex items-center justify-center px-6 py-3 text-[11px] font-black text-white bg-gradient-to-r from-indigo-600 to-violet-600 rounded-2xl hover:from-indigo-700 hover:to-violet-700 hover:shadow-xl hover:shadow-indigo-200 transition-all duration-300 uppercase tracking-[0.2em] active:scale-95">
        <x-lucide-plus class="w-4 h-4 mr-2 stroke-[3] group-hover:rotate-90 transition-transform duration-300" />
        Tambah Varian Warna
    </button>

    <template x-teleport="body">
        <div x-show="open" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center p-4">

            <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" @click="open = false">
            </div>

            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="relative w-full max-w-md bg-white rounded-3xl p-8 shadow-2xl border border-white/20">

                <h3 class="text-xl font-bold mb-6 text-slate-800">Tambah Varian</h3>

                <form wire:submit.prevent="save" class="space-y-5">
                    <div>
                        <label
                            class="block text-xs font-bold mb-2 uppercase tracking-wider text-slate-500">Warna</label>
                        <select wire:model="id_color" required
                            class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 font-bold text-sm transition-all">
                            <option value="">Pilih warna</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->nama_warna }}</option>
                            @endforeach
                        </select>
                        @error('id_color')
                            <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold mb-2 uppercase tracking-wider text-slate-500">Gambar
                            Varian</label>
                        <input type="file" wire:model="image" accept="image/*"
                            class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-2 text-slate-800 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer">
                        @error('image')
                            <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($image)
                        <div class="mt-2 p-2 bg-slate-50 rounded-2xl border border-dashed border-slate-300">
                            <img src="{{ $image->temporaryUrl() }}"
                                class="w-full h-44 object-cover rounded-xl shadow-sm" alt="Preview">
                        </div>
                    @endif

                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" @click="open = false"
                            class="px-6 py-3 text-[11px] font-black text-slate-500 bg-slate-100 rounded-xl hover:bg-slate-200 transition-all uppercase tracking-widest">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-3 text-[11px] font-black text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-200 transition-all uppercase tracking-widest">
                            Simpan Varian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
