<div>
    <x-ui.card-item class=" border-none! shadow-none! p-0!">
        <x-slot:header class="px-10 py-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="relative z-10 flex items-center gap-6">
                <div
                    class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center shadow-lg rotate-3 transition-transform hover:rotate-0">
                    <x-lucide-layers class="w-8 h-8 text-emerald-600" />
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight uppercase italic">Varian Produk</h1>
                    <p class="text-emerald-500 font-bold mt-1 tracking-wider uppercase text-xs">
                        Kelola Varian & Spesifikasi
                    </p>
                </div>
            </div>
            <livewire:admin.variant.create :product="$product" :key="'variant-create-' . $product->id" />
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

                            <div class="flex items-center space-x-2">
                                <livewire:admin.variant.edit :product="$product" :variant="$variant" :key="'variant-edit-' . $variant->id" />
                                <x-ui.button variant="delete" size="md" icon="trash"
                                    @click="$dispatch('open-delete-variant', { id: {{ $variant->id }} })" />
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
                                        <livewire:admin.spec.create :product="$product" :variant="$variant"
                                            :key="'spec-create-' . $variant->id" />
                                    </div>


                                    @forelse ($variant->specs as $spec)
                                        <div class="flex items-center justify-between bg-slate-50 rounded-xl px-4 py-3">
                                            <div class="flex flex-col  items-start justify-center">
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
                                            <div class="flex items-center gap-2">
                                                <livewire:admin.spec.edit :spec="$spec" :product="$product"
                                                   :variant="$variant" :key="'spec-edit-' . $spec->id" />
                                                <x-ui.button variant="delete" size="md" icon="trash"
                                                    @click="$dispatch('open-delete-spec', { id: {{ $spec->id }} })" />
                                            </div>
                                        </div>
                                    @empty
                                        <x-ui.empty-state icon="clipboard-list" title="Spek Kosong"
                                            message="Belum ada spesifikasi yang ditambahkan"
                                            class="py-4 border-2 border-dashed border-slate-100 rounded-2xl" />
                                    @endforelse
                                </div>
                            </div>
                        </x-slot>

                    </x-ui.card-item>

                @empty
                    <x-ui.empty-state
                        full
                        icon="layers"
                        class="lg:col-span-2"
                        title="Varian Kosong"
                        message="Belum ada varian warna"
                    />
                @endforelse
            </div>
        </x-slot>

    </x-ui.card-item>

    {{-- Delete Modal for Variant --}}
    <x-ui.modal.delete trigger="open-delete-variant" action="deleteVariant" title="Hapus Varian Warna?"
        message="Semua spesifikasi dan gambar dalam varian ini akan ikut terhapus." :errorMessage="$errorMessage" />

    {{-- Delete Modal for Spec --}}
    <x-ui.modal.delete trigger="open-delete-spec" action="deleteSpec" title="Hapus Spesifikasi?"
        message="Data stok dan harga untuk spesifikasi ini akan dihapus." :errorMessage="$errorMessage" />
</div>