<div class="flex flex-col gap-6 py-4">
    <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
        class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />

    {{-- Product Information Card --}}
    <x-ui.card-item class="p-4 md:p-6 space-y-6 bg-white rounded-2xl shadow-sm border overflow-hidden">
        <x-slot:header class="border-b pb-3 border-slate-100 flex gap-4">
            <div
                class="w-10 h-10 md:w-12 md:h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-black/10">
                <x-lucide-square-pen class="size-6 text-white" />
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-800">Edit Product</h1>
                <p class="text-slate-500 text-sm italic">{{ $product->nama_product }}</p>
            </div>
        </x-slot:header>

        <x-slot>
            <div class="flex flex-col gap-4">
                <div class="flex items-center">
                    <h2 class="text-base font-bold text-slate-800 uppercase tracking-wide">1 Product Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-ui.form.label label="Nama Produk" />
                        <x-ui.form.input model="nama_product" type="text" />
                    </div>

                    <div>
                        <x-ui.form.label label="Brand" />
                        <x-ui.form.select model="id_brand">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->nama_brand }}</option>
                            @endforeach
                        </x-ui.form.select>
                    </div>

                    <div>
                        <x-ui.form.label label="Kategori" />
                        <x-ui.form.select model="id_category" :disabled="$product->variants->count() > 0"
                            class="{{ $product->variants->count() > 0 ? 'opacity-60 cursor-not-allowed' : 'cursor-pointer' }}">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_category }}</option>
                            @endforeach
                        </x-ui.form.select>

                        @if ($product->variants->count() > 0)
                            <span class="text-amber-500 text-xs mt-2 ml-2 font-bold uppercase block italic">
                                Terkunci: Produk memiliki varian
                            </span>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <x-ui.form.label label="Deskripsi" />
                        <x-ui.form.textarea model="deskripsi" rows="3" />
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot:footer class="flex justify-end">
            <x-ui.button type="button" variant="update-ghost" icon="check" label="Simpan Perubahan"
                loadingTarget="updateProduct" wire:click="updateProduct" />
        </x-slot:footer>
    </x-ui.card-item>

    {{-- Variant & Spec Management Card --}}
    <x-ui.card-item class="p-4 md:p-6 space-y-6 bg-white rounded-2xl shadow-sm border overflow-hidden">
        <livewire:admin.variant.index :product="$product" :key="'variant-manager-' . $product->id" />
    </x-ui.card-item>

    <div class="flex items-center justify-between pt-4">
        <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />

        <p class="text-slate-400 text-[10px] tracking-widest uppercase italic">
            &copy; 2025 Praktikum Web &bull; Management System
        </p>
    </div>

    <x-ui.modal.delete title="Hapus Data?" message="Yakin ingin menghapus data ini? Data tidak bisa dikembalikan."
        :errorMessage="$errorMessage" />
</div>