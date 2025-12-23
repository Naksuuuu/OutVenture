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
                            {{ $category->name_category }}</h3>
                        <p class="text-gray-400 text-sm mt-1 leading-relaxed">
                            {{ Str::limit($category->description, 60) }}</p>
                    </div>
                    <div class="flex gap-2">

                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                            class="p-2 text-gray-400 hover:text-emerald-500 hover:bg-emerald-50 rounded-lg transition">
                            ✏️
                        </a>


                        {{-- <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                            onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                🗑️
                            </button>
                        </form> --}}
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                    <span class="text-emerald-600 font-bold text-sm bg-emerald-50 px-3 py-1 rounded-full">
                        {{ $category->products_count ?? 0 }} Products
                    </span>
                    <span class="text-gray-300 text-xs font-medium">ID: #{{ $category->id }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
