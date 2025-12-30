<div class="">
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
                            Edit Warna</h1>
                        <p class="text-sm text-slate-500 mt-1">{{ $color->nama_warna }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-10">

                @if ($isUsedInVariants)
                    <div class="bg-red-50 border-l-4 border-red-400 p-5 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-red-400 mr-3 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="text-sm font-bold text-red-800">Warna Tidak Dapat Diubah</h3>
                                <p class="text-sm text-red-700 mt-1">
                                    Warna ini sedang digunakan pada <span class="font-bold">{{ $variantsCount }} varian
                                        produk</span> dan tidak dapat diubah untuk menjaga konsistensi data.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @error('used_in_variants')
                    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-lg">
                        {{ $message }}
                    </div>
                @enderror

                <form wire:submit.prevent="update">
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
                                <input wire:model.live="nama_warna" type="text"
                                    placeholder="Contoh: Merah, Biru, Hijau" {{ $isUsedInVariants ? 'disabled' : '' }}
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium {{ $isUsedInVariants ? 'opacity-60 cursor-not-allowed' : '' }}">
                                @error('nama_warna')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Kode
                                    Hex Warna
                                </label>
                                <div class="flex gap-3">
                                    <input wire:model.live="hex_code" type="color"
                                        {{ $isUsedInVariants ? 'disabled' : '' }}
                                        class="w-20 h-14 bg-white border-2 border-slate-200 rounded-2xl cursor-pointer {{ $isUsedInVariants ? 'opacity-60 cursor-not-allowed' : '' }}">
                                    <input wire:model.live="hex_code" type="text" placeholder="#000000"
                                        {{ $isUsedInVariants ? 'disabled' : '' }}
                                        class="flex-1 bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium {{ $isUsedInVariants ? 'opacity-60 cursor-not-allowed' : '' }}">
                                </div>
                                @error('hex_code')
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
                                    <div class="w-16 h-16 rounded-full border-4 border-white shadow-lg"
                                        style="background-color: {{ $hex_code ?? '#000000' }};">
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">{{ $nama_warna ?: 'Nama warna' }}
                                        </p>
                                        <p class="text-xs text-slate-500">{{ $hex_code ?? '#000000' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="flex items-center justify-end px-8 py-6 mt-8">
                        <x-ui.button type="submit" variant="update"
                            :label="$isUsedInVariants ? 'Tidak Dapat Diubah' : 'Simpan Perubahan'"
                            class="px-8 py-4 shadow-xl shadow-emerald-200 {{ $isUsedInVariants ? 'opacity-50 cursor-not-allowed' : '' }}"
                            :disabled="$isUsedInVariants" />
                    </div>
                </form>

            </div>

            <div class="bg-slate-50/80 px-8 py-6 flex items-center border-t border-slate-100">
                <x-ui.back-link href="{{ route('admin.colors.index') }}" wire:navigate />
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
            &copy; 2025 Praktikum Web &bull; Management System
        </p>
    </div>
</div>
