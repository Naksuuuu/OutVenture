<div class="p-8 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Categories Management</h2>
            <p class="text-gray-500 font-medium">Organize your products by categories</p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
            class="bg-emerald-500 text-white px-5 py-2.5 rounded-xl font-bold flex items-center hover:bg-emerald-600 transition shadow-lg shadow-emerald-100">
            <span class="mr-2">+</span> Add Category
        </a>
    </div>

    <div class="mb-8 max-w-md">
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-emerald-500">🔍</span>
            <input type="text" placeholder="Search categories..."
                class="w-full pl-10 pr-4 py-2.5 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white shadow-sm">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($categories as $category)
            <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition group">
                <div class="flex justify-between items-start mb-4">
                    <div>

                        <h3 class="text-xl font-bold text-gray-800 group-hover:text-emerald-600 transition">
                            {{ $category->nama_category }}</h3>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                            class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-indigo-600 bg-white border border-indigo-200 rounded-md hover:bg-indigo-50 transition-all uppercase tracking-wider">
                            <x-bxs-edit class="w-4 h-4" />
                        </a>

                        <button wire:click="deleteCategory({{ $category->id }})" wire:confirm="Hapus kategori ini?"
                            class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-red-600 bg-white border border-red-200 rounded-md hover:bg-red-50 transition-all uppercase tracking-wider">
                            <x-eos-delete class="w-4 h-4" />
                        </button>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                    <span class="text-emerald-600 font-bold text-sm bg-emerald-50 px-3 py-1 rounded-full">
                        {{ $category->products_count ?? 0 }} Products
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
