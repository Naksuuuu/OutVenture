<div class="min-h-screen py-12 px-4 sm:px-6">


    @if (session('success'))
        <div class="fixed bottom-10 right-10 p-6 w-fit bg-green-400/90 rounded-lg border border-green-400 mb-2">
            {{ session('success') }}
        </div>
    @endif

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
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                            Edit Product</h1>
                        <p class="text-slate-500 text-sm italic">
                            {{ $product->nama_product }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit="update">
                <div class="p-8 md:p-10 space-y-10">
                    {{-- 01 Product Information --}}
                    <section>
                        <div class="flex items-center space-x-2 mb-6">
                            <span class="text-indigo-600 font-bold text-lg">01</span>
                            <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                                Product Information
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-3">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Product
                                    Name</label>
                                <input type="text" wire:model="nama_product"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                    placeholder="e.g., GORE-TEX Waterproof Jacket">
                                @error('nama_product')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-1">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Brand</label>
                                <select wire:model="id_brand"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 appearance-none font-medium cursor-pointer">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $product->id_brand == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->nama_brand }}</option>
                                    @endforeach
                                </select>
                                @error('id_brand')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-1">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Category</label>
                                <select wire:model="id_category"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 appearance-none font-medium cursor-pointer">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->id_category == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-3">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Short
                                    Description</label>
                                <textarea wire:model="deskripsi" rows="4"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 font-medium">{{ $product->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    {{-- 02 Variants Warna --}}
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-2">
                                <span class="text-indigo-600 font-bold text-lg">02</span>
                                <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                                    Variants & Specifications
                                </h2>
                            </div>

                            <livewire:admin.variant.create :product="$product" />
                        </div>

                        <div class="overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 p-6">
                            <div class="space-y-6">
                                @foreach ($product->variants as $variant)
                                    <div
                                        class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden group hover:border-indigo-300 transition-all duration-300">

                                        <div class="bg-slate-50/80 px-6 py-4 border-b border-slate-100">
                                            <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                                                <div class="flex items-center space-x-4">
                                                    @if (isset($variant_new_images[$variant->id]))
                                                        <img src="{{ $variant_new_images[$variant->id]->temporaryUrl() }}"
                                                            class="w-20 h-20 object-cover rounded-lg border-2 border-indigo-500 shadow-sm"
                                                            alt="New Image">
                                                    @elseif ($variant->image)
                                                        <img src="{{ asset('storage/' . $variant->image) }}"
                                                            class="w-20 h-20 object-cover rounded-lg border-2 border-slate-200 shadow-sm"
                                                            alt="{{ $variant->color->nama_warna ?? 'Variant' }}">
                                                    @else
                                                        <div
                                                            class="w-20 h-20 bg-slate-200 rounded-lg border-2 border-slate-200 flex items-center justify-center">
                                                            <x-lucide-image class="w-8 h-8 text-slate-400" />
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <label
                                                            class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Warna
                                                            Varian</label>
                                                        <select wire:model="variant_colors.{{ $variant->id }}"
                                                            class="bg-white border border-slate-200 rounded-lg px-3 py-2 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                                                            @foreach ($colors as $color)
                                                                <option value="{{ $color->id }}">{{ $color->nama_warna }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <livewire:admin.spec.create :product="$product" :variant="$variant"
                                                        :key="'spec-create-' . $variant->id" />

                                                    <button type="button"
                                                        onclick="if(!confirm('Hapus varian ini?')) { event.stopImmediatePropagation(); return; }"
                                                        wire:click="deleteVariant({{ $variant->id }})"
                                                        class="inline-flex items-center justify-center px-3 py-2 text-[11px] font-black text-white bg-red-500 border border-red-500 rounded-xl hover:bg-red-600 transition-all duration-200 uppercase tracking-widest shadow-sm">
                                                        Hapus Varian
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- Upload Gambar Baru --}}
                                            <div class="border-t border-slate-200 pt-4">
                                                <label
                                                    class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Upload
                                                    Gambar Baru</label>
                                                <input type="file" wire:model="variant_new_images.{{ $variant->id }}"
                                                    accept="image/*"
                                                    class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-800 file:mr-2 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                                                @error('variant_new_images.' . $variant->id)
                                                    <span
                                                        class="text-red-500 text-[9px] mt-1 font-bold uppercase block">{{ $message }}</span>
                                                @enderror

                                                @if (isset($variant_new_images[$variant->id]))
                                                    <div class="mt-4 grid grid-cols-2 gap-4">
                                                        <div>
                                                            <p
                                                                class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-2">
                                                                Gambar Lama:</p>
                                                            @if ($variant->image)
                                                                <img src="{{ asset('storage/' . $variant->image) }}"
                                                                    class="w-full h-40 object-cover rounded-lg border-2 border-slate-300 shadow-md">
                                                            @else
                                                                <div
                                                                    class="w-full h-40 bg-slate-200 rounded-lg border-2 border-slate-300 flex items-center justify-center">
                                                                    <span class="text-[10px] text-slate-400 font-bold">Tidak ada
                                                                        gambar</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <p
                                                                class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest mb-2">
                                                                Gambar Baru:</p>
                                                            <img src="{{ $variant_new_images[$variant->id]->temporaryUrl() }}"
                                                                class="w-full h-40 object-cover rounded-lg border-2 border-indigo-500 shadow-md">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="p-4">
                                            <table class="w-full text-left">
                                                <thead>
                                                    <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                        <th class="px-4 pb-2">Kode SKU
                                                        </th>
                                                        <th class="px-4 pb-2">Harga
                                                            Jual</th>
                                                        <th class="px-4 pb-2">Stok
                                                            Tersedia</th>
                                                        <th class="px-4 pb-2 text-center">
                                                            Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-slate-50">
                                                    @foreach ($variant->specs as $spec)
                                                        <tr>
                                                            <td class="px-4 py-3">
                                                                <span
                                                                    class="font-mono text-sm font-bold text-slate-600 bg-slate-100 px-2 py-1 rounded-md uppercase">
                                                                    {{ $spec->sku }}
                                                                </span>
                                                            </td>
                                                            <td class="px-4 py-3">
                                                                <span class="text-sm font-bold text-slate-800">
                                                                    Rp{{ number_format($spec->harga, 0, ',', '.') }}
                                                                </span>
                                                            </td>
                                                            <td class="px-4 py-3">
                                                                <div class="flex items-center">
                                                                    <span
                                                                        class="text-sm font-black {{ $spec->stok > 10 ? 'text-indigo-600' : 'text-amber-500' }}">
                                                                        {{ $spec->stok }}
                                                                    </span>
                                                                    <span
                                                                        class="text-[10px] text-slate-400 ml-1 font-bold uppercase">Unit</span>
                                                                </div>
                                                            </td>
                                                            <td class="px-4 py-3 text-right">
                                                                <div class="flex items-center justify-center gap-3">
                                                                    <livewire:admin.spec.edit :spec="$spec"
                                                                        :product="$product" :variant="$variant" :key="'spec-edit-' . $spec->id" />

                                                                    <livewire:admin.spec.delete :spec="$spec"
                                                                        :variant="$variant" :key="'spec-delete-' . $spec->id" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    {{-- Submit button untuk form product info --}}
                    <div class="flex items-center justify-end px-8 py-6">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-xl shadow-indigo-200 transition-all active:scale-95">
                            Save Product Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-slate-50/80 px-8 py-6 flex items-center justify-center border-t border-slate-100">
            <a href="{{ route('admin.products.index') }}" wire:navigate
                class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
        &copy; 2025 Praktikum Web &bull; Management System
    </p>
</div>
