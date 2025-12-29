<div class="">



    <x-ui.page-header title="Manajemen Grup Ukuran" subtitle="Kelola grup ukuran dan nilainya untuk kategori produk."
        class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>
            <livewire:ui.dropdown wire:model.live="sortBy" :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']" class="" />


            <x-ui.search-input model="search" placeholder="Cari grup ukuran..." width="" />


            <x-ui.button.create size="size-4" href="{{ route('admin.sizes.create') }}" label="Tambah" />
        </x-slot:actions>
    </x-ui.page-header>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @forelse ($sizeGroups as $sizeGroup)

            <x-ui.card-item class="p-3 flex flex-col justify-between h-[250px]">
                <x-slot:header class="flex justify-between w-full">
                    <div class="flex items-center gap-3">
                        <div>
                            <a href="{{ route('admin.sizes.show', $sizeGroup->id) }}" wire:navigate
                                class="text-lg font-bold text-gray-800 hover:text-indigo-600 transition-colors">
                                {{ $sizeGroup->nama_group }}
                            </a>
                            <p class="text-sm text-gray-500">
                                {{ $sizeGroup->values_count }} nilai ukuran
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-ui.button.edit href="{{ route('admin.sizes.edit', $sizeGroup->id) }}"
                            class="rounded-lg! p-2!" size="size-6" />
                        <x-ui.button.delete :id="$sizeGroup->id" />
                    </div>
                </x-slot:header>

                <x-slot>
                    <h4 class="text-sm font-bold  uppercase tracking-wider mb-2">Nilai Ukuran</h4>
                    <div class="flex flex-wrap gap-1.5">
                        @forelse ($sizeGroup->values->take(6) as $value)
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                {{ $value->label_size }}
                            </span>
                        @empty
                            <span class="text-xs text-gray-400 italic">No values</span>
                        @endforelse
                        @if ($sizeGroup->values_count > 6)
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-600">
                                +{{ $sizeGroup->values_count - 6 }} more
                            </span>
                        @endif
                    </div>
                </x-slot>

                <x-slot:footer class="flex items-center justify-between pt-2 border-t border-gray-100">
                    <span class="text-sm font-bold uppercase tracking-wider">Digunakan pada
                        <span class="text-blue-600">{{ $sizeGroup->categories_count }}</span> kategori</span>
                </x-slot:footer>
            </x-ui.card-item>

        @empty
            <div class="col-span-full bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="text-gray-400 text-sm italic">
                    Belum ada grup ukuran.
                </div>
            </div>
        @endforelse
    </div>

    <x-ui.modal.delete title="Hapus Grup Ukuran?" message="Yakin ingin menghapus grup ukuran ini?" :errorMessage="$errorMessage" />

    <div class="mt-8">
        <div class="px-6 py-4">
            {{ $sizeGroups->links() }}
        </div>
    </div>
</div>
