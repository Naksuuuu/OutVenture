<div class="p-8 bg-gray-50/50 min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Categories</h2>
            <p class="text-gray-500 mt-1">Organize and manage your product catalog structure</p>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:w-80">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <x-fas-search class="w-4 h-4" />
                </span>
                <input type="text" wire:model.live="search" placeholder="Search categories..."
                    class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white shadow-sm transition-all">
            </div>

            <a href="{{ route('admin.categories.create') }}"
                class="flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2 rounded-xl font-semibold text-sm transition-all shadow-sm">
                <x-ri-add-fill class="w-5 h-5" />
                <span>Add New</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($categories as $category)
            <div
                class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:border-emerald-100 transition-all duration-300 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 text-gray-50 group-hover:text-emerald-50 transition-colors">
                    <x-ri-stack-line class="w-24 h-24" />
                </div>

                <div class="relative">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-emerald-600 font-bold text-lg group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-inner">
                            <img src="{{ asset('storage/tenda.jpg') }}"
                                class="w-12 h-12 object-cover opacity-80 group-hover:opacity-90 transition duration-300"
                                alt="">
                            {{-- {{ substr($category->nama_category, 0, 1) }} --}}
                            {{-- {{ $category-> image  }} --}}
                        </div>

                        <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                <x-bxs-edit class="w-4 h-4" />
                            </a>
                            <button wire:click="deleteCategory({{ $category->id }})" wire:confirm="Hapus kategori ini?"
                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <x-eos-delete class="w-4 h-4" />
                            </button>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">{{ $category->nama_category }}
                        </h3>
                        <div class="flex items-center text-gray-500">
                            <x-ri-shopping-bag-3-line class="w-3.5 h-3.5 mr-1.5" />
                            <span class="text-xs font-medium uppercase tracking-wider">
                                {{ $category->products_count ?? 0 }} Total Products
                            </span>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-t border-gray-50">
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-emerald-500 h-1.5 rounded-full"
                                style="width: {{ min(($category->products_count ?? 0) * 5, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
