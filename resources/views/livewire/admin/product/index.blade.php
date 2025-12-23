<div class="bg-gray-50 min-h-screen p-8">
    <div class="mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Produk</h1>
                <p class="text-sm text-gray-500 mt-1">Total {{ $products->total() }} produk dalam database.</p>
            </div>
            <a href="#"
                class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Produk
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left table-fixed border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="w-[40%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Informasi
                            Produk</th>
                        <th class="w-[20%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Brand
                        </th>
                        <th
                            class="w-[20%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">
                            Kategori</th>
                        <th
                            class="w-[20%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span
                                        class="text-sm font-bold text-gray-800 tracking-tight leading-tight">{{ $product->nama_product }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="text-sm text-gray-600">{{ $product->brand->nama_brand ?? 'Tanpa Brand' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold {{ $product->category ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-gray-50 text-gray-400 border border-gray-100' }}">
                                    {{ $product->category->nama_category ?? 'TANPA KATEGORI' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" wire:navigate
                                        class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-indigo-600 bg-white border border-indigo-200 rounded-md hover:bg-indigo-50 transition-all uppercase tracking-wider">
                                        Edit
                                    </a>
                                    <form action="" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-red-600 bg-white border border-red-200 rounded-md hover:bg-red-50 transition-all uppercase tracking-wider"
                                            onclick="return confirm('Hapus produk?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm italic">Data produk
                                belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
