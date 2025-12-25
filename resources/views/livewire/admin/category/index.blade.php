<div class="p-8 bg-gray-50/50 min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kategori</h2>
            <p class="text-gray-500 mt-1">Atur dan kelola struktur katalog produk Anda</p>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:w-80">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <x-lucide-search class="w-4 h-4" />
                </span>
                <input type="text" wire:model.live.debounce="search" placeholder="Cari kategori..."
                    class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white shadow-sm transition-all">
            </div>

            <a href="{{ route('admin.categories.create') }}" wire:navigate
                class="flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2 rounded-xl font-semibold text-sm transition-all shadow-sm">
                <x-lucide-plus class="w-5 h-5" />
                <span>Tambah Baru</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-6">
        @foreach ($categories as $category)
            <div
                class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl hover:border-emerald-100 transition-all duration-300 relative overflow-hidden">

                <div class="absolute -right-4 -top-4 text-gray-50 group-hover:text-emerald-50 transition-colors">
                    <x-lucide-layers class="w-30 h-30" />
                </div>

                <div class="relative flex items-center gap-6 h-[150px]">
                    <div
                        class="w-40 h-full bg-gray-50 rounded-xl flex items-center justify-center text-emerald-600 font-bold text-lg  group-hover:text-white transition-all duration-300 shadow-inner">
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}"
                                class="w-full h-full object-cover opacity-80 group-hover:opacity-90 transition duration-300"
                                alt="">
                        @elseif (!$category->image)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none"
                                viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        @endif
                    </div>

                    <div class="flex-1 h-full flex flex-col justify-center">
                        <a href="{{ route('admin.categories.show', $category->id) }}" wire:navigate
                            class="text-xl font-bold text-gray-800 mb-1 leading-tight">
                            {{ $category->nama_category }}
                        </a>
                        <div class="flex items-center text-gray-500">
                            <x-lucide-handbag class="w-3.5 h-3.5 mr-1.5" />
                            <span class="text-xs font-medium uppercase tracking-wider">
                                {{ $category->products_count ?? 0 }} Total Produk
                            </span>
                        </div>
                    </div>

                    <div
                        class="flex items-start mt-4 h-full gap-1 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                            class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                            <x-lucide-square-pen />
                        </a>
                        <livewire:admin.category.delete :category="$category->id" :key="'category-delete-' . $category->id" />
                    </div>

                </div>

            </div>
        @endforeach
    </div>
</div>
