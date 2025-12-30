<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.categories.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>

    <div class="mx-auto">

        <x-ui.card-item class="overflow-hidden" rounded="rounded-[2.5rem]" shadow="shadow-xl shadow-slate-200/50"
            border="border border-slate-100">

            <x-slot:header class="px-10 py-10 ">
                <div class="relative z-10 flex items-center gap-6">
                    <div
                        class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center shadow-lg  rotate-3 transition-transform hover:rotate-0">
                        <x-lucide-square-pen class="w-8 h-8 text-emerald-600" />
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Edit Kategori</h1>
                        <p class="text-emerald-400 font-bold mt-1 tracking-wider uppercase text-xs">
                            {{ $category->nama_category }}
                        </p>
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <form wire:submit.prevent="update" class="space-y-10">
                        <div class="flex flex-col gap-12">
                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">01</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Data Kategori
                                    </h2>
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Nama Kategori" />
                                    <x-ui.form.input wire:model="nama_category" type="text" />
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Kelompok Ukuran" />
                                    <x-ui.form.select wire:model="id_size_group"
                                        :disabled="$category->products()->exists()"
                                        class="{{ $category->products()->exists() ? 'cursor-not-allowed opacity-50' : '' }}">
                                        <option value="">Pilih Size Group</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}" {{ $category->id_size_group == $size->id ? 'selected' : '' }}>
                                                {{ $size->nama_group }}
                                            </option>
                                        @endforeach
                                    </x-ui.form.select>
                                    @if ($category->products()->exists())
                                        <span class="text-amber-500 text-xs mt-2 ml-2 font-bold uppercase block italic">
                                            Terkunci: Kategori ini memiliki produk
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">02</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Visual
                                        Kategori
                                    </h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-ui.form.label label="Gambar Saat Ini" />
                                        <div
                                            class="aspect-square rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner flex items-center justify-center group relative">
                                            @if ($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                    class="w-full h-full object-cover opacity-60">
                                            @else
                                                <x-ui.image-placeholder icon="image" size="sm" class="opacity-50" />
                                            @endif
                                        </div>
                                    </div>

                                    <x-ui.form.image-upload wire:model="new_image" :image="$new_image"
                                        label="Upload Baru" />
                                </div>
                            </div>
                        </div>

                        <x-ui.button type="submit" variant="update-ghost" icon="check" label="Simpan Perubahan" />
                    </form>
                </div>
            </x-slot>

        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.categories.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>
</div>