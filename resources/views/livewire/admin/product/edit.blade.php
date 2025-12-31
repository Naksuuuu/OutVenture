<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>

    <div class="mx-auto space-y-10">

        {{-- Product Information Card --}}
        <x-ui.card-item class="overflow-hidden" rounded="rounded-[2.5rem]" shadow="shadow-xl shadow-slate-200/50"
            border="border border-slate-100">

            <x-slot:header class="px-10 py-10 ">
                <div class="relative z-10 flex items-center gap-6">
                    <div
                        class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center shadow-lg  rotate-3 transition-transform hover:rotate-0">
                        <x-lucide-square-pen class="w-8 h-8 text-emerald-600" />
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Edit Produk</h1>
                        <p class="text-emerald-500 font-bold mt-1 tracking-wider uppercase text-xs">
                            {{ $product->nama_product }}
                        </p>
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <div class="flex flex-col gap-12">
                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">01</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Informasi Produk</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="group md:col-span-2">
                                    <x-ui.form.label label="Nama Produk" />
                                    <x-ui.form.input wire:model="nama_product" type="text" />
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Brand" />
                                    <x-ui.form.select wire:model="id_brand">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->nama_brand }}</option>
                                        @endforeach
                                    </x-ui.form.select>
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Kategori" />
                                    <x-ui.form.select wire:model="id_category" :disabled="$product->variants->count() > 0"
                                        class="{{ $product->variants->count() > 0 ? 'opacity-60 cursor-not-allowed' : 'cursor-pointer' }}">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
                                        @endforeach
                                    </x-ui.form.select>

                                    @if ($product->variants->count() > 0)
                                        <div
                                            class="flex items-center gap-2 mt-2 text-amber-600 bg-amber-50 px-3 py-2 rounded-lg border border-amber-100">
                                            <x-lucide-lock class="w-3 h-3" />
                                            <span class="text-[10px] font-bold uppercase tracking-wide">
                                                Terkunci: Produk memiliki varian
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">02</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Detail Produk</h2>
                            </div>

                            <div class="group">
                                <x-ui.form.label label="Deskripsi Singkat" />
                                <x-ui.form.textarea wire:model="deskripsi" rows="4" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-8 mt-8 border-t border-slate-100">
                        <x-ui.button type="button" variant="update-ghost" icon="check" label="Simpan Perubahan"
                            loadingTarget="updateProduct" wire:click="updateProduct" />
                    </div>
                </div>
            </x-slot>
        </x-ui.card-item>

        {{-- Variant & Spec Management Card --}}
        <x-ui.card-item class="p-4 md:p-6 space-y-6 bg-white shadow-sm border overflow-hidden" rounded="rounded-4xl"
            shadow="shadow-xl shadow-slate-200/50">
            <livewire:admin.variant.index :product="$product" :key="'variant-manager-' . $product->id" />
        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />


    </div>

    <x-ui.modal.delete title="Hapus Produk?" message="Yakin ingin menghapus produk ini? Data tidak bisa dikembalikan."
        :errorMessage="$errorMessage" />
</div>