<div class="flex flex-col gap-6 py-4">
    <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
        class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />


    <x-ui.card-item class="p-6 md:p-8 space-y-6 bg-white rounded-2xl shadow-sm border overflow-hidden">
        <x-slot:header class="border-b pb-3 border-slate-100 flex  gap-4">
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
                            <span class="text-amber-500 text-xs mt-2 ml-2 font-bold uppercase block italic">Terkunci:
                                Produk
                                memiliki varian</span>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <x-ui.form.label label="Deskripsi" />
                        <x-ui.form.textarea model="deskripsi" rows="3" />
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot:footer class="flex justify-end ">
            <x-ui.button.action target="updateProduct" label="Simpan Perubahan" />
        </x-slot:footer>
    </x-ui.card-item>

    <x-ui.card-item class="p-6 md:p-8 space-y-6 bg-white rounded-2xl shadow-sm border overflow-hidden">
        <x-slot:header class="border-b pb-3 border-slate-100 flex items-center gap-4">
            <div
                class="w-10 h-10 md:w-12 md:h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-black/10">
                <x-lucide-square-pen class="size-6 text-white" />
            </div>
            <h1 class="text-xl font-bold text-slate-800">Variant & Spesifikasi</h1>
        </x-slot:header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @forelse ($product->variants as $variant)
                <div
                    class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden flex flex-col group hover:border-indigo-300 transition-all duration-500">

                    <div class="px-8 py-5 bg-slate-50/50 border-b border-slate-100 flex justify-between items-center">
                        <div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Warna
                                Varian</span>
                            <select wire:model="variant_colors.{{ $variant->id }}"
                                @if ($variant->specs->count() > 0) disabled @endif
                                class="bg-transparent border-none p-0 text-sm font-black text-indigo-600 focus:ring-0 uppercase">
                                @foreach ($colors as $color)
                                    @php
                                        $disabled =
                                            in_array($color->id, $usedColorIds ?? []) &&
                                            $color->id !== $variant->id_color;
                                    @endphp
                                    <option value="{{ $color->id }}"
                                        @if ($disabled) disabled @endif>{{ $color->nama_warna }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center space-x-2">
                            <livewire:admin.spec.create :product="$product" :variant="$variant" :key="'spec-create-' . $variant->id" />
                            <x-ui.button.delete :id="$variant->id" />
                        </div>
                    </div>

                    <div class="p-8 space-y-6 flex-grow">
                        <div
                            class="aspect-[16/10] w-full bg-slate-100 rounded-3xl overflow-hidden relative group/media border-4 border-white shadow-inner">
                            @if (isset($variant_new_images[$variant->id]))
                                <img src="{{ $variant_new_images[$variant->id]->temporaryUrl() }}"
                                    class="w-full h-full object-cover">
                            @elseif ($variant->image)
                                <img src="{{ asset('storage/' . $variant->image) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <x-lucide-image class="w-12 h-12 text-slate-300" />
                                </div>
                            @endif

                            <label
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover/media:opacity-100 transition-opacity flex flex-col items-center justify-center cursor-pointer backdrop-blur-[2px]">
                                <x-lucide-upload class="w-8 h-8 text-white mb-2" />
                                <span class="text-white text-[10px] font-bold uppercase tracking-widest">Update Foto
                                    Varian</span>
                                <input type="file" wire:model="variant_new_images.{{ $variant->id }}"
                                    class="hidden" accept="image/*">
                            </label>
                        </div>

                        <div class="space-y-3">
                            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">
                                Spesifikasi Detail</h3>

                            @forelse ($variant->specs as $spec)
                                <div
                                    class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl group/item hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-slate-100">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-mono text-xs font-bold text-slate-600 uppercase tracking-tighter">{{ $spec->sku }}</span>
                                        <div class="flex items-center mt-1">
                                            <span class="text-[10px] font-bold text-indigo-500 uppercase">Stok:</span>
                                            <span
                                                class="text-[10px] font-black text-slate-800 ml-1">{{ $spec->stok }}
                                                Unit</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-4">
                                        <span
                                            class="text-sm font-black text-slate-800">Rp{{ number_format($spec->harga, 0, ',', '.') }}</span>
                                        <div
                                            class="flex items-center opacity-0 group-hover/item:opacity-100 transition-opacity">
                                            <livewire:admin.spec.edit :spec="$spec" :product="$product"
                                                :variant="$variant" :key="'spec-edit-' . $spec->id" />
                                            <x-ui.button.delete :id="$spec->id" />
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-4 text-center border-2 border-dashed border-slate-100 rounded-2xl">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Belum ada spek</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="px-8 py-5 bg-slate-50/30 border-t border-slate-100 flex justify-end">
                        <button type="button" wire:click="update"
                            class="text-indigo-600 text-[10px] font-black uppercase tracking-[0.2em] hover:text-indigo-800 transition-colors">
                            Simpan Perubahan Varian
                        </button>
                    </div>
                </div>
            @empty
                <div
                    class="lg:col-span-2 bg-white rounded-[2.5rem] p-16 text-center border-2 border-dashed border-slate-200">
                    <x-lucide-package-open class="w-16 h-16 mx-auto text-slate-200 mb-4" />
                    <p class="text-slate-500 font-bold uppercase tracking-widest">Belum ada varian warna</p>
                </div>
            @endforelse
        </div>
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
