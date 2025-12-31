<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>

    <div class="mx-auto">

        <x-ui.card-item class="overflow-hidden" rounded="rounded-[2.5rem]" shadow="shadow-xl shadow-slate-200/50"
            border="border border-slate-100">

            <x-slot:header class="px-10 py-10 ">
                <div class="relative z-10 flex items-center gap-6">
                    <div
                        class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center shadow-lg  rotate-3 transition-transform hover:rotate-0">
                        <x-lucide-plus class="w-8 h-8 text-blue-600" />
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Tambah Produk</h1>
                        <p class="text-blue-400 font-bold mt-1 tracking-wider uppercase text-xs">
                            Produk Baru
                        </p>
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <form wire:submit.prevent="saveProduct" class="space-y-10">
                        <div class="flex flex-col gap-12">
                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-black text-sm">01</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Informasi Produk</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="group md:col-span-2">
                                        <x-ui.form.label label="Nama Produk" />
                                        <x-ui.form.input wire:model.live="nama_product" type="text"
                                            placeholder="Contoh: Tenda Camping Dome" />
                                    </div>

                                    <div class="group">
                                        <x-ui.form.label label="Brand" />
                                        <x-ui.form.select wire:model="id_brand">
                                            <option value="">Pilih Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->nama_brand }}</option>
                                            @endforeach
                                        </x-ui.form.select>
                                    </div>

                                    <div class="group">
                                        <x-ui.form.label label="Kategori" />
                                        <x-ui.form.select wire:model="id_category">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->nama_category }}
                                                </option>
                                            @endforeach
                                        </x-ui.form.select>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-black text-sm">02</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Detail Produk</h2>
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Deskripsi Singkat" />
                                    <x-ui.form.textarea wire:model="deskripsi" rows="4"
                                        placeholder="Tuliskan deskripsi singkat tentang produk ini..." />
                                </div>
                            </div>
                        </div>

                        <x-ui.button type="submit" variant="create-ghost" icon="check" label="Simpan Produk" />
                    </form>
                </div>
            </x-slot>

        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>
</div>