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
                        class="w-16 h-16 bg-black rounded-2xl flex items-center justify-center shadow-lg  rotate-3 transition-transform hover:rotate-0">
                        <x-lucide-eye class="w-8 h-8 text-white" />
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Detail Produk</h1>
                        <p class="text-slate-400 font-bold mt-1 tracking-wider uppercase text-xs">
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
                                    class="size-10 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-black text-sm">01</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Informasi Dasar</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="group md:col-span-2">
                                    <x-ui.form.label label="Nama Produk" />
                                    <h3 class="text-lg font-bold text-slate-800">{{ $product->nama_product }}</h3>
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Brand" />
                                    <div class="flex items-center gap-2">
                                        <div class="px-3 py-1 bg-slate-50 rounded-lg border border-slate-100">
                                            <span
                                                class="font-bold text-slate-700">{{ $product->brand->nama_brand ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Kategori" />
                                    <div class="flex items-center gap-2">
                                        <div class="px-3 py-1 bg-indigo-50 rounded-lg border border-indigo-100">
                                            <span
                                                class="font-bold text-indigo-700">{{ $product->category->nama_category ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-black text-sm">02</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Deskripsi & Metadata</h2>
                            </div>

                            <div class="group">
                                <x-ui.form.label label="Deskripsi Lengkap" />
                                <div
                                    class="p-6 bg-slate-50 rounded-2xl border border-slate-100 text-slate-600 leading-relaxed text-sm">
                                    {{ $product->deskripsi ?: 'Tidak ada deskripsi.' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-ui.card-item>

        {{-- Variant & Spec (Read Only) --}}
        <x-ui.card-item class="overflow-hidden" rounded="rounded-[2.5rem]" shadow="shadow-xl shadow-slate-200/50"
            border="border border-slate-100">
            <x-slot:header class="px-10 py-8 bg-slate-50/50 border-b border-slate-100">
                <div class="flex items-center gap-4">
                    <x-lucide-layers class="w-6 h-6 text-slate-400" />
                    <h2 class="text-lg font-black uppercase tracking-wide text-slate-700">Varian & Spesifikasi</h2>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        @forelse ($product->variants as $variant)
                            <x-ui.card-item rounded="rounded-3xl"
                                class="border border-slate-100 shadow-sm overflow-hidden flex flex-col group hover:border-slate-300 transition-all duration-300">
                                <x-slot:header
                                    class="px-6 py-4 bg-white border-b border-slate-100 flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full shadow-sm ring-1 ring-slate-100"
                                            style="background-color: {{ $variant->color->hex_code ?? '#000000' }}"></div>
                                        <div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Warna
                                            </p>
                                            <h3 class="font-bold text-slate-800">{{ $variant->color->nama_warna }}</h3>
                                        </div>
                                    </div>
                                </x-slot:header>
                                <x-slot>
                                    <div class="p-6 space-y-6">
                                        @if ($variant->image)
                                            <div
                                                class="aspect-video w-full rounded-2xl overflow-hidden border border-slate-100 shadow-inner">
                                                <img src="{{ asset('storage/' . $variant->image) }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        @endif

                                        <div class="space-y-3">
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Daftar
                                                Spesifikasi</p>
                                            <div class="w-full">
                                                <x-ui.table class="!border-none">
                                                    <x-ui.table.body class="!divide-y !divide-dashed !divide-slate-200">
                                                        @forelse ($variant->specs as $spec)
                                                            <x-ui.table.row class="hover:bg-transparent">
                                                                <x-ui.table.cell class="py-2 pl-0">
                                                                    <span
                                                                        class="font-mono font-bold text-slate-700 text-sm bg-slate-100 px-2 py-1 rounded">{{ $spec->size->label_size ?? 'ALL' }}</span>
                                                                </x-ui.table.cell>
                                                                <x-ui.table.cell class="py-2">
                                                                    <div class="flex flex-col">
                                                                        <span
                                                                            class="text-[10px] text-slate-400 uppercase">SKU</span>
                                                                        <span
                                                                            class="font-mono text-xs font-bold text-slate-600">{{ $spec->sku }}</span>
                                                                    </div>
                                                                </x-ui.table.cell>
                                                                <x-ui.table.cell class="py-2 font-bold text-slate-700">
                                                                    {{ Number::currency($spec->harga, 'IDR', precision: 0) }}
                                                                </x-ui.table.cell>
                                                                <x-ui.table.cell class="py-2 text-right pr-0">
                                                                    <span
                                                                        class="text-xs font-bold {{ $spec->stok > 10 ? 'text-emerald-600 bg-emerald-50' : 'text-amber-600 bg-amber-50' }} px-2 py-1 rounded-lg border {{ $spec->stok > 10 ? 'border-emerald-100' : 'border-amber-100' }}">
                                                                        Stok: {{ $spec->stok }}
                                                                    </span>
                                                                </x-ui.table.cell>
                                                            </x-ui.table.row>
                                                        @empty
                                                            <x-ui.table.row>
                                                                <x-ui.table.cell colspan="4"
                                                                    class="text-center text-slate-400 text-xs italic py-4">
                                                                    Belum ada spesifikasi
                                                                </x-ui.table.cell>
                                                            </x-ui.table.row>
                                                        @endforelse
                                                    </x-ui.table.body>
                                                </x-ui.table>
                                            </div>
                                        </div>
                                    </div>
                                </x-slot>
                            </x-ui.card-item>
                        @empty
                            <div class="col-span-full py-12 text-center">
                                <p class="text-slate-400 italic">Belum ada varian produk.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </x-slot>
        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />

        <div class="flex gap-4">
            <x-ui.link href="{{ route('admin.products.edit', $product->slug) }}" label="Edit Produk" size="md"
                variant="update" icon="square-pen" />
        </div>
    </div>
</div>