<div>
    <x-ui.card-item class=" border-none! shadow-none! p-0!">
        <x-slot:header
            class="flex flex-col md:flex-row items-start gap-3 md:gap-0 md:items-center md:justify-between mb-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-10 h-10 md:w-12 md:h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-black/10">
                    <x-lucide-square-pen class="size-6 text-white" />
                </div>
                <h1 class="text-xl font-bold text-slate-800">Variant & Spesifikasi</h1>
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
                                    <livewire:admin.spec.create :product="$product" :variant="$variant" :key="'spec-create-' . $variant->id" />
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
                                            <div class="text-[11px] {{ $spec->stok <= 10 ? 'text-red-500' : 'text-black' }}">Stok:
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
                                    <div class="py-4 text-center border-2 border-dashed border-slate-100 rounded-2xl">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">Belum ada spek</p>
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

    {{-- Delete Modal for Variant --}}
    <x-ui.modal.delete trigger="open-delete-variant" action="deleteVariant" title="Hapus Varian Warna?"
        message="Semua spesifikasi dan gambar dalam varian ini akan ikut terhapus." :errorMessage="$errorMessage" />

    {{-- Delete Modal for Spec --}}
    <x-ui.modal.delete trigger="open-delete-spec" action="deleteSpec" title="Hapus Spesifikasi?"
        message="Data stok dan harga untuk spesifikasi ini akan dihapus." :errorMessage="$errorMessage" />
</div>