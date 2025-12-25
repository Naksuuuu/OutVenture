<div class="bg-gray-50 min-h-screen p-8">

    @if (session('success'))
        <div class="fixed bottom-10 right-10 p-6 w-fit bg-green-400/90 rounded-lg border border-green-400 mb-2 z-50">
            {{ session('success') }}
        </div>
    @endif

    <div class="mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Produk</h1>
                <p class="text-sm text-gray-500 mt-1">Total {{ $totalProducts ?? $products->count() }} produk di
                    database.</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-indigo-500">
                        <x-lucide-search class="w-5 h-5" />
                    </span>
                    <input type="text" wire:model.live.debounce="search" placeholder="Cari produk..."
                        class="w-64 pl-10 pr-4 py-2.5 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white text-indigo-700 shadow-sm">
                </div>

                <a href="{{ route('admin.products.create') }}" wire:navigate
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-sm">
                    <x-lucide-plus class="w-5 h-5" />
                    Tambah Produk
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left table-fixed border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="w-[40%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Informasi
                            Produk</th>
                        <th class="w-[20%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Merek
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
                                    class="text-sm text-gray-600">{{ $product->brand->nama_brand ?? 'No Brand' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold {{ $product->category ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-gray-50 text-gray-400 border border-gray-100' }}">
                                    {{ $product->category->nama_category ?? 'NO CATEGORY' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.products.show', $product) }}" wire:navigate
                                        class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-slate-700 bg-white border border-slate-200 rounded-md hover:bg-slate-50 transition-all uppercase tracking-wider"
                                        title="Lihat">
                                        <x-lucide-eye class="w-4 h-4" />
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" wire:navigate
                                        class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-indigo-600 bg-white border border-indigo-200 rounded-md hover:bg-indigo-50 transition-all uppercase tracking-wider">
                                        <x-lucide-square-pen class="w-4 h-4" />
                                    </a>
                                    <form action="" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-red-600 bg-white border border-red-200 rounded-md hover:bg-red-50 transition-all uppercase tracking-wider"
                                            onclick="return confirm('Hapus produk?')">
                                            <x-lucide-trash class="w-4 h-4" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm italic">Tidak ada
                                produk
                                available yet.</td>
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
