<div x-data="{ open: @entangle('isOpen') }">

    <button type="button" @click="open = true"
        class="group inline-flex items-center justify-center px-6 py-3 text-[11px] font-black text-white bg-gradient-to-r from-indigo-600 to-violet-600 rounded-2xl hover:from-indigo-700 hover:to-violet-700 hover:shadow-xl hover:shadow-indigo-200 transition-all duration-300 uppercase tracking-[0.2em] active:scale-95">
        <svg class="w-4 h-4 mr-2 stroke-[3] group-hover:rotate-90 transition-transform duration-300" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15">
            </path>
        </svg>
        Tambah Varian Warna
    </button>


    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/40" @click="open = false"></div>
        <div class="relative w-full max-w-md bg-white rounded-2xl p-6 shadow-2xl">
            <h3 class="text-lg font-bold mb-4">Tambah Varian
            </h3>
            <form wire:submit.prevent="save">
                <label class="block text-xs font-bold mb-2">Warna</label>
                <select wire:model="id_color" required
                    class="w-full mb-4 bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 font-bold text-sm">
                    <option value="">Pilih warna</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">
                            {{ $color->nama_warna }}
                        </option>
                    @endforeach
                </select>
                @error('id_color')
                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                @enderror
                {{-- Tambah field lain yang dibutuhkan storeVariant --}}
                <div class="flex justify-end gap-2">
                    <button type="button" @click="open = false"
                        class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-slate-500 bg-white border border-slate-200 rounded-xl hover:bg-slate-100 transition-all duration-300 uppercase tracking-widest shadow-sm">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-white bg-indigo-600 border border-indigo-600 rounded-xl hover:bg-indigo-700 transition-all duration-200 uppercase tracking-widest shadow-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>



</div>
