<div class="flex flex-col gap-6 py-4">
    <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
        class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />

    {{-- Product Information Card --}}
    <x-ui.card-item class="p-4 md:p-6 space-y-6 bg-white rounded-2xl shadow-sm border overflow-hidden">
        <x-slot:header class="border-b pb-3 border-slate-100 flex gap-4">
            <div
                class="w-10 h-10 md:w-12 md:h-12 bg-black rounded-2xl flex items-center justify-center shadow-lg shadow-black/10">
                <x-lucide-box class="size-6 text-white" />
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-800">Detail Produk</h1>
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
                        <x-ui.form.input value="{{ $product->nama_product }}" type="text" disabled
                            class="bg-slate-100! text-slate-500!" />
                    </div>

                    <div>
                        <x-ui.form.label label="Brand" />
                        <x-ui.form.input value="{{ $product->brand->nama_brand ?? '-' }}" type="text" disabled
                            class="bg-slate-100! text-slate-500!" />
                    </div>

                    <div>
                        <x-ui.form.label label="Kategori" />
                        <x-ui.form.input value="{{ $product->category->nama_category ?? '-' }}" type="text" disabled
                            class="bg-slate-100! text-slate-500!" />
                    </div>

                    <div class="md:col-span-2">
                        <x-ui.form.label label="Deskripsi" />
                        <textarea rows="3" disabled
                            class="w-full bg-slate-100 border-none rounded-2xl px-5 py-4 text-slate-500 shadow-inner focus:ring-0 font-medium resize-none">{{ $product->deskripsi }}</textarea>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-ui.card-item>

    {{-- Variant & Spec Management Card (Read Only) --}}
    <x-ui.card-item class="p-4 md:p-6 space-y-6 bg-white rounded-2xl shadow-sm border overflow-hidden">
        <x-ui.card-item class=" border-none! shadow-none! p-0!">
            <x-slot:header
                class="flex flex-col md:flex-row items-start gap-3 md:gap-0 md:items-center md:justify-between mb-6">
                <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 md:w-12 md:h-12 bg-black rounded-2xl flex items-center justify-center shadow-lg shadow-black/10">
                        <x-lucide-shopping-bag class="size-6 text-white" />
                    </div>
                    <h1 class="text-xl font-bold text-slate-800">Variant & Spesifikasi</h1>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @forelse ($product->variants as $variant)
                        <x-ui.card-item rounded="rounded-4xl"
                            class="border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden flex flex-col group hover:border-indigo-300 transition-all duration-500">
                            <x-slot:header
                                class="px-8 py-5 bg-slate-50/50 border-b border-slate-100 flex justify-between items-center">
                                <div>
                                    <x-ui.form.label label="Warna Varian" />
                                    <h3 class="text-lg font-bold tracking-tight"
                                        style="color: {{ $variant->color->hex_code ?? '#000000' }}">
                                        {{ $variant->color->nama_warna }}
                                    </h3>
                                </div>
                            </x-slot:header>
                            <x-slot>
                                <div class="p-2 md:p-4 space-y-6 ">
                                    <div
                                        class="aspect-[16/10] w-full bg-slate-100 rounded-3xl overflow-hidden relative group/media border-4 border-white shadow-inner">
                                        @if ($variant->image)
                                            <img src="{{ asset('storage/' . $variant->image) }}"
                                                class="w-full h-full object-cover object-center">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <x-lucide-image class="w-12 h-12 text-slate-300" />
                                            </div>
                                        @endif
                                    </div>

                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <x-ui.form.label label="Detail Spesifikasi" class="mb-0!" />
                                        </div>

                                        @forelse ($variant->specs as $spec)
                                            <div class="flex items-center justify-between bg-slate-50 rounded-xl px-4 py-3">
                                                <div class="flex flex-col  items-center">
                                                    <span class="text-sm font-medium">UKURAN:
                                                        {{ $spec->size->label_size ?? '-' }}</span>
                                                    <span class="text-sm font-medium">SKU:
                                                        <span class="text-blue-500">{{ $spec->sku }}</span></span>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-sm font-bold">
                                                        {{ Number::currency($spec->harga, 'IDR', precision: 0) }}
                                                    </div>
                                                    <div
                                                        class="text-[11px] {{ $spec->stok <= 10 ? 'text-red-500' : 'text-black' }}">
                                                        Stok:
                                                        {{ $spec->stok }}
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="py-4 text-center border-2 border-dashed border-slate-100 rounded-2xl">
                                                <p class="text-[10px] font-bold text-slate-400 uppercase">Belum ada spek
                                                </p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </x-slot>

                        </x-ui.card-item>

                    @empty
                        <div
                            class="lg:col-span-2 bg-white rounded-[2.5rem] p-16 text-center border-2 border-dashed border-slate-200">
                            <x-lucide-package-open class="w-16 h-16 mx-auto text-slate-200 mb-4" />
                            <p class="text-slate-500 font-bold uppercase tracking-widest">Belum ada varian warna</p>
                        </div>
                    @endforelse
                </div>
            </x-slot>
        </x-ui.card-item>
    </x-ui.card-item>

    <div class="flex items-center justify-between pt-4">
        <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />

        <p class="text-slate-400 text-[10px] tracking-widest uppercase italic">
            &copy; 2025 Praktikum Web &bull; Management System
        </p>
    </div>
</div>