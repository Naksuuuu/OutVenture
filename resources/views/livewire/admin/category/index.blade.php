<div class="">
    <x-ui.page-header title="Kategori" subtitle="Kelola struktur katalog produk Anda dengan sistem yang
                lebih rapi." class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>
            <livewire:ui.dropdown wire:model.live="sortBy" :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']"
                class="" />


            <x-ui.search-input model="search" placeholder="Cari kategori..." width="" />

            <x-ui.link href="{{ route('admin.categories.create') }}" label="Tambah" icon="plus" variant="create" />
        </x-slot:actions>
    </x-ui.page-header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4 ">
        @forelse ($categories as $category)
            <x-ui.card-item
                class="group justify-self-center flex flex-col justify-between h-[550px] w-full max-w-xl p-3 transition-all duration-300"
                rounded="rounded-2xl" hover="hover:shadow-lg hover:-translate-y-2">
                <x-slot:header class="w-full aspect-square h-3/4 bg-black/10 rounded-2xl overflow-hidden">
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}"
                            class="h-full w-full object-cover object-center transition duration-700 group-hover:scale-110"
                            alt="{{ $category->nama_category }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <x-lucide-image class="w-12 h-12" />
                        </div>
                    @endif
                </x-slot:header>



                <x-slot>
                    <div class=" rounded-b-2xl h-1/4 p-4 flex flex-col justify-between">
                        <div class="flex justify-between w-full items-center">
                            <a href="{{ route('admin.categories.show', $category) }}" wire:navigate
                                class="text-lg font-extrabold text-gray-900 uppercase tracking-wide hover:text-emerald-600 transition-colors">
                                {{ $category->nama_category }}
                            </a>


                            <div class="flex items-center gap-2 text-gray-600">
                                <div class="w-7 h-7 rounded-full bg-emerald-50 flex items-center justify-center">
                                    <x-lucide-package class="w-4 h-4 text-emerald-600" />
                                </div>
                                <span class="text-xs font-bold uppercase tracking-widest">
                                    {{ $category->products_count ?? 0 }} Produk
                                </span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2">



                            <x-ui.link href="{{ route('admin.categories.edit', $category) }}" label='edit' icon="square-pen"
                                size="md" variant="edit" class="flex-1" />
                            <x-ui.button variant="delete" size="md" icon="trash"
                                @click="$dispatch('open-delete-modal', { id: {{ $category->id }} })" />
                        </div>
                    </div>

                </x-slot>
            </x-ui.card-item>

        @empty
            <div class="col-span-full bg-white rounded-2xl p-16 text-center border border-dashed border-gray-300">
                <x-lucide-folder-open class="w-16 h-16 mx-auto text-gray-300 mb-4" />
                <p class="text-gray-500 font-medium">Belum ada kategori</p>
                <p class="text-sm text-gray-400 mt-2">Klik tombol "Tambah Kategori" untuk membuat kategori baru</p>
            </div>
        @endforelse
    </div>
    <div class="px-6 py-4 ">
        {{ $categories->links('components.ui.pagination') }}
    </div>

    <x-ui.modal.delete title="Hapus Kategori?" message="Yakin ingin menghapus kategori ini?"
        :errorMessage="$errorMessage" />

</div>