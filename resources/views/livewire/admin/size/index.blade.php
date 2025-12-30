<div class="">

    <x-ui.page-header title="Manajemen Grup Ukuran" subtitle="Kelola grup ukuran dan nilainya untuk kategori produk."
        class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>
            <livewire:ui.dropdown wire:model.live="sortBy" :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']"
                class="" />


            <x-ui.search-input model="search" placeholder="Cari grup ukuran..." width="" />


            <x-ui.link href="{{ route('admin.sizes.create') }}" label="Tambah" icon="plus" variant="create" />
        </x-slot:actions>
    </x-ui.page-header>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
        @forelse ($sizeGroups as $sizeGroup)
            <x-ui.card-item
                class="group justify-self-center flex flex-col justify-between h-[350px] w-full max-w-xl p-3 transition-all duration-300"
                rounded="rounded-2xl" hover="hover:shadow-lg hover:-translate-y-2">

                <x-slot:header
                    class="w-full h-1/2 bg-indigo-50/50 rounded-2xl overflow-hidden flex items-center justify-center border border-indigo-100/50 group-hover:bg-indigo-50 transition-colors">
                    <div class="flex flex-col items-center gap-2">
                        <div class="p-3 bg-white rounded-xl shadow-sm border border-indigo-100">
                            <x-lucide-ruler class="w-8 h-8 text-indigo-500" />
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-indigo-300">Size Group</span>
                    </div>
                </x-slot:header>

                <x-slot>
                    <div class="rounded-b-2xl h-1/2 pt-4 pb-2 px-2 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <a href="{{ route('admin.sizes.show', $sizeGroup->id) }}" wire:navigate
                                    class="text-lg font-extrabold text-slate-800 uppercase tracking-wide hover:text-indigo-600 transition-colors line-clamp-1">
                                    {{ $sizeGroup->nama_group }}
                                </a>
                                <span
                                    class="text-[10px] font-bold px-2 py-1 bg-slate-100 rounded-lg text-slate-500 border border-slate-200">
                                    {{ $sizeGroup->values_count }} Size
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @forelse ($sizeGroup->values->take(5) as $value)
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-white text-slate-600 border border-slate-200 shadow-sm">
                                        {{ $value->label_size }}
                                    </span>
                                @empty
                                    <span class="text-[10px] text-slate-400 italic font-medium">Belum ada nilai</span>
                                @endforelse
                                @if ($sizeGroup->values_count > 5)
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                                        +{{ $sizeGroup->values_count - 5 }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mt-auto">
                            <x-ui.link href="{{ route('admin.sizes.edit', $sizeGroup->id) }}" label='Edit' icon="square-pen"
                                size="md" variant="edit" class="flex-1" />
                            <x-ui.button variant="delete" size="md" icon="trash"
                                @click="$dispatch('open-delete-modal', { id: {{ $sizeGroup->id }} })" />
                        </div>
                    </div>
                </x-slot>
            </x-ui.card-item>

        @empty
            <div class="col-span-full bg-white rounded-2xl p-16 text-center border-2 border-dashed border-slate-200">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <x-lucide-ruler class="w-8 h-8 text-slate-300" />
                </div>
                <p class="text-slate-800 font-bold text-lg">Belum ada grup ukuran</p>
                <p class="text-sm text-slate-400 mt-1 mb-6">Tambahkan grup ukuran baru untuk mengatur varian produk</p>
                <x-ui.link href="{{ route('admin.sizes.create') }}" label="Buat Grup Ukuran" icon="plus" variant="create" />
            </div>
        @endforelse
    </div>

    <x-ui.modal.delete title="Hapus Grup Ukuran?" message="Yakin ingin menghapus grup ukuran ini?"
        :errorMessage="$errorMessage" />

    <div class="mt-8">
        <div class="px-6 py-4">
            {{ $sizeGroups->links() }}
        </div>
    </div>
</div>