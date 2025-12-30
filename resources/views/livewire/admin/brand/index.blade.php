<div>
    <x-ui.page-header title="Merek" subtitle="Kelola dan atur identitas merek produk Anda"
        class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>
            <livewire:ui.dropdown wire:model.live="sort" :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']"
                class="" />

            <x-ui.search-input model="search" placeholder="Cari merek..." width="" />


            <x-ui.link href="{{ route('admin.brands.create') }}" label="Tambah" icon="plus" variant="create" />
        </x-slot:actions>
    </x-ui.page-header>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4  gap-4 ">
        @forelse ($brands as $brand)
            <x-ui.card-item
                class="group justify-self-center flex flex-col justify-between h-[550px] w-full max-w-xl p-3 transition-all duration-300"
                rounded="rounded-2xl" hover="hover:shadow-lg hover:-translate-y-2">
                <x-slot:header class="w-full h-3/4 bg-black/10 rounded-2xl overflow-hidden relative">
                    @if ($brand->is_trusted)
                        <div
                            class="absolute top-4 right-4 bg-emerald-100/90 text-emerald-600  p-1 rounded-full flex items-center shadow-lg  z-10">
                            <x-lucide-check-circle class="w-4 h-4" />
                        </div>
                    @endif
                    @if ($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}"
                            class="h-full w-full object-cover object-center transition duration-700 group-hover:scale-110"
                            alt="{{ $brand->nama_brand }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <x-lucide-image class="w-12 h-12" />
                        </div>
                    @endif
                </x-slot:header>



                <x-slot>
                    <div class=" rounded-b-2xl h-1/4 p-4 flex flex-col gap-1 justify-between">
                        <div class="flex w-full justify-between">
                            <a href="{{ route('admin.brands.show', $brand) }}" wire:navigate
                                class="text-lg font-extrabold text-gray-900 uppercase tracking-wide hover:text-emerald-600 transition-colors">
                                {{ $brand->nama_brand }}
                            </a>


                            <div class="flex items-center gap-2 text-gray-600">
                                <div class="w-7 h-7 rounded-full bg-emerald-50 flex items-center justify-center">
                                    <x-lucide-package class="size-4 text-emerald-600" />
                                </div>


                                <span class="text-xs font-bold uppercase tracking-widest">
                                    {{ $brand->products_count ?? 0 }} Produk
                                </span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2">


                            <x-ui.link href="{{ route('admin.brands.edit', $brand) }}" label='edit' icon="square-pen"
                                size="md" class="flex-1" variant="edit" />
                            <x-ui.button variant="delete" size="md" icon="trash"
                                @click="$dispatch('open-delete-modal', { id: {{ $brand->id }} })" />
                        </div>
                    </div>

                </x-slot>
            </x-ui.card-item>

        @empty
            <div class="col-span-full bg-white rounded-2xl p-16 text-center border border-dashed border-gray-300">
                <x-lucide-package-open class="w-16 h-16 mx-auto text-gray-300 mb-4" />
                <p class="text-gray-500 font-medium">Belum ada brand</p>
                <p class="text-sm text-gray-400 mt-2">Klik tombol "Tambah Brand" untuk membuat brand baru</p>
            </div>
        @endforelse
    </div>

    <x-ui.modal.delete title="Hapus Brand?" message="Yakin ingin menghapus brand ini?" :errorMessage="$errorMessage" />

</div>