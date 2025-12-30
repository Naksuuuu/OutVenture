<div class="max-w-3xl mx-auto">
    <x-ui.card-item class="rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <x-slot:header class="bg-emerald-600 text-white p-8 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl">
            </div>
            <div class="flex items-center gap-6 relative z-10">
                <div
                    class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-inner border border-white/30">
                    <x-lucide-square-pen class="w-8 h-8 text-white" />
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-white mb-1">Edit Warna</h1>
                    <p class="text-emerald-100 font-medium">{{ $color->nama_warna }}</p>
                </div>
            </div>
        </x-slot:header>


        <div class="p-8 md:p-10 space-y-10">
            @if ($isUsedInVariants)
                <div class="bg-red-50 border-l-4 border-red-400 p-5 rounded-r-xl">
                    <div class="flex items-start gap-4">
                        <x-lucide-alert-triangle class="w-6 h-6 text-red-500 shrink-0" />
                        <div>
                            <h3 class="font-bold text-red-800">Warna Tidak Dapat Diubah</h3>
                            <p class="text-sm text-red-700 mt-1 leading-relaxed">
                                Warna ini sedang digunakan pada <span
                                    class="font-black bg-red-100 px-1 rounded">{{ $variantsCount }} varian
                                    produk</span>.
                                Perubahan data tidak diizinkan untuk menjaga konsistensi.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @error('used_in_variants')
                <div
                    class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-lg font-bold flex items-center gap-2">
                    <x-lucide-x-circle class="w-5 h-5" />
                    {{ $message }}
                </div>
            @enderror

            <form wire:submit="update" class="space-y-10">
                <div class="space-y-8">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 font-bold text-sm">01</span>
                        <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">Informasi Warna</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="md:col-span-2">
                            <x-ui.form.label label="Nama Warna" />
                            <x-ui.form.input type="text" id="nama_warna" model="nama_warna" modifier=".live"
                                placeholder="Contoh: Merah, Biru, Hijau" :disabled="$isUsedInVariants"
                                class="{{ $isUsedInVariants ? 'opacity-60 cursor-not-allowed bg-slate-100' : '' }}" />
                        </div>

                        <div class="md:col-span-2">
                            <x-ui.form.label label="Kode Hex Warna" />
                            <div class="flex gap-4">
                                <div class="shrink-0 relative">
                                    <input type="color" wire:model.live="hex_code" :disabled="$isUsedInVariants"
                                        class="w-16 h-14 bg-white border-2 border-slate-200 rounded-2xl cursor-pointer p-1 {{ $isUsedInVariants ? 'opacity-60 cursor-not-allowed' : '' }}">
                                </div>
                                <div class="flex-1">
                                    <x-ui.form.input type="text" model="hex_code" modifier=".live" placeholder="#000000"
                                        :disabled="$isUsedInVariants"
                                        class="font-mono uppercase {{ $isUsedInVariants ? 'opacity-60 cursor-not-allowed bg-slate-100' : '' }}" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <x-ui.form.label label="Preview Warna" />
                        <div class="flex items-center gap-5 bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <div class="w-20 h-20 rounded-full border-4 border-white shadow-lg transition-colors duration-300"
                                style="background-color: {{ $hex_code ?? '#000000' }};">
                            </div>
                            <div class="space-y-1">
                                <p class="text-base font-bold text-slate-800">{{ $nama_warna ?: 'Nama warna' }}
                                </p>
                                <p
                                    class="text-sm font-mono text-slate-500 uppercase bg-white px-2 py-1 rounded inline-block shadow-sm">
                                    {{ $hex_code ?? '#000000' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="flex items-center justify-end pt-6 border-t border-slate-100">
            <x-ui.button type="submit" variant="update" size="lg" :label="$isUsedInVariants ? 'Tidak Dapat Diubah' : 'Simpan Perubahan'"
                class="px-10 shadow-emerald-200 shadow-xl {{ $isUsedInVariants ? 'opacity-50 cursor-not-allowed' : '' }}"
                :disabled="$isUsedInVariants" />
        </div>
        </form>
</div>

<div class="bg-slate-50 px-8 py-6 flex items-center border-t border-slate-100">
    <x-ui.back-link href="{{ route('admin.colors.index') }}" />
</div>

</x-ui.card-item>
</div>