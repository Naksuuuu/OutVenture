<div class="">
    <x-ui.page-header title="Kategori"
        subtitle="Kelola struktur katalog produk Anda dengan sistem yang
                lebih rapi."
        class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>
            <livewire:ui.dropdown wire:model.live="sortBy" :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']" class="" />


            <x-ui.search-input model="search" placeholder="Cari kategori..." width="" />

            <x-ui.button-href href="{{ route('admin.categories.create') }}" label="Tambah" />
        </x-slot:actions>
    </x-ui.page-header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 ">
        @forelse ($categories as $category)
            {{-- <div
                class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden relative">

                <div
                    class="absolute -right-6 -bottom-6 text-slate-50 group-hover:text-emerald-50/50 transition-colors duration-500">
                    <x-lucide-layers class="w-32 h-32" />
                </div>

                <div class="relative flex flex-col h-full">
                    <div class="h-48 overflow-hidden relative bg-slate-100">
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                                alt="{{ $category->nama_category }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <x-lucide-image class="w-12 h-12" />
                            </div>
                        @endif

                        <div
                            class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="p-2.5 bg-white/90 backdrop-blur text-slate-600 hover:text-emerald-600 rounded-xl shadow-xl transition-colors">
                                <x-lucide-square-pen class="w-5 h-5" />
                            </a>
                            <livewire:admin.category.delete :category="$category->id" :key="'category-delete-' . $category->id" />
                        </div>
                    </div>

                    <div class="p-6 flex-1 bg-white relative">
                        <a href="{{ route('admin.categories.show', $category->id) }}" wire:navigate
                            class="text-xl font-black text-slate-800 hover:text-emerald-600 transition-colors block mb-2 tracking-tight">
                            {{ $category->nama_category }}
                        </a>
                        <div class="flex items-center text-slate-400">
                            <div class="w-7 h-7 rounded-full bg-emerald-50 flex items-center justify-center mr-3">
                                <x-lucide-package class="w-4 h-4 text-emerald-600" />
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-500">
                                {{ $category->products_count ?? 0 }} Produk
                            </span>
                        </div>
                    </div>
                </div>
            </div> --}}

            <x-ui.card-item
                class="justify-self-center flex flex-col justify-between h-[550px] w-full max-w-xl p-3 transition-all duration-300"
                rounded="rounded-2xl" hover="hover:shadow-lg hover:-translate-y-2">
                <x-slot:header class="w-full h-3/4 bg-black/10 rounded-2xl">
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
                    <div class=" rounded-b-2xl h-1/4 p-4 flex justify-between">
                        <div class="flex flex-col">
                            <a href="{{ route('admin.categories.show', $category->id) }}" wire:navigate
                                class="text-lg font-extrabold text-gray-900 uppercase tracking-wide hover:text-emerald-600 transition-colors">
                                {{ $category->nama_category }}
                            </a>


                            <div class="mt-4 flex items-center text-gray-600">
                                <div class="w-7 h-7 rounded-full bg-emerald-50 flex items-center justify-center mr-3">
                                    <x-lucide-package class="w-4 h-4 text-emerald-600" />
                                </div>
                                <span class="text-xs font-bold uppercase tracking-widest">
                                    {{ $category->products_count ?? 0 }} Produk
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <x-ui.button-href href="{{ route('admin.categories.edit', $category->id) }}"
                                icon="square-pen" class="bg-transparent shadow-none px-10 ">
                                <x-slot name="iconSlot" class="text-indigo-400 size-6"></x-slot>
                            </x-ui.button-href>

                            <livewire:admin.category.delete :category="$category->id" :key="'category-delete-' . $category->id" />
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
</div>
