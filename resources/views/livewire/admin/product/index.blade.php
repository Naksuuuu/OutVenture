<div class="bg-gray-50 min-h-screen p-4 md:p-8">

    @if (session('success'))
        <div class="fixed bottom-4 md:bottom-10 right-4 md:right-10 p-4 md:p-6 w-fit bg-green-400/90 rounded-lg border border-green-400 mb-2 z-50">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="fixed bottom-4 md:bottom-10 right-4 md:right-10 p-4 md:p-6 w-fit bg-red-400/90 rounded-lg border border-red-400 mb-2 z-50">
            {{ session('error') }}
        </div>
    @endif

    <div class="mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 md:mb-8 gap-4 md:gap-0">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Manajemen Produk</h2>
                <p class="text-sm text-gray-500 mt-1">Total {{ $totalProducts ?? $products->count() }} produk di
                    database.</p>
            </div>

            <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full md:w-auto">
                <select wire:model.live="sort"
                    class="px-4 py-2.5 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white text-gray-700 shadow-sm w-full md:w-auto">
                    <option value="terbaru">Terbaru</option>
                    <option value="terlama">Terlama</option>
                </select>

                <div class="relative w-full md:w-auto">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-indigo-500">
                        <x-lucide-search class="w-5 h-5" />
                    </span>
                    <input type="text" wire:model.live.debounce="search" placeholder="Cari produk..."
                        class="w-full md:w-64 pl-10 pr-4 py-2.5 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white text-indigo-700 shadow-sm">
                </div>

                <a href="{{ route('admin.products.create') }}" wire:navigate
                    class="flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 md:px-5 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-sm w-full md:w-auto">
                    <x-lucide-plus class="w-5 h-5" />
                    Tambah Produk
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Mobile Card View -->
            <div class="block md:hidden">
                <div class="divide-y divide-gray-100">
                    @forelse ($products as $product)
                        <div class="p-4 hover:bg-gray-50/50 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex-1">
                                    <span class="text-sm font-bold text-gray-800 tracking-tight leading-tight">{{ $product->nama_product }}</span>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Merek: {{ $product->brand->nama_brand ?? 'No Brand' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Kategori: {{ $product->category->nama_category ?? 'NO CATEGORY' }}
                                    </div>
                                </div>
                                <div class="flex gap-1 ml-2">
                                    <a href="{{ route('admin.products.show', $product) }}" wire:navigate
                                        class="inline-flex items-center justify-center px-3 py-1.5 text-[11px] font-bold text-slate-700 bg-white border border-slate-200 rounded-md hover:bg-slate-50 transition-all uppercase tracking-wider"
                                        title="Lihat">
                                        <x-lucide-eye class="w-4 h-4" />
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" wire:navigate
                                        class="inline-flex items-center justify-center px-3 py-1.5 text-[11px] font-bold text-indigo-600 bg-white border border-indigo-200 rounded-md hover:bg-indigo-50 transition-all uppercase tracking-wider">
                                        <x-lucide-square-pen class="w-4 h-4" />
                                    </a>
                                    <button type="button" wire:click="deleteProduct({{ $product->id }})"
                                        onclick="return confirm('Hapus produk ini?')"
                                        class="inline-flex items-center justify-center px-3 py-1.5 text-[11px] font-bold text-red-600 bg-white border border-red-200 rounded-md hover:bg-red-50 transition-all uppercase tracking-wider">
                                        <x-lucide-trash class="w-4 h-4" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-gray-400 text-sm italic">Tidak ada produk available yet.</div>
                    @endforelse
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left table-fixed border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="w-[40%] px-4 md:px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Informasi
                                Produk</th>
                            <th class="w-[20%] px-4 md:px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Merek
                            </th>
                            <th
                                class="w-[20%] px-4 md:px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">
                                Kategori</th>
                            <th
                                class="w-[20%] px-4 md:px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="px-4 md:px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-bold text-gray-800 tracking-tight leading-tight">{{ $product->nama_product }}</span>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-4">
                                    <span
                                        class="text-sm text-gray-600">{{ $product->brand->nama_brand ?? 'No Brand' }}</span>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold {{ $product->category ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-gray-50 text-gray-400 border border-gray-100' }}">
                                        {{ $product->category->nama_category ?? 'NO CATEGORY' }}
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4">
                                    <div class="flex justify-center items-center gap-1 md:gap-2">
                                        <a href="{{ route('admin.products.show', $product) }}" wire:navigate
                                            class="inline-flex items-center justify-center px-3 md:px-4 py-1.5 text-[11px] font-bold text-slate-700 bg-white border border-slate-200 rounded-md hover:bg-slate-50 transition-all uppercase tracking-wider"
                                            title="Lihat">
                                            <x-lucide-eye class="w-4 h-4" />
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" wire:navigate
                                            class="inline-flex items-center justify-center px-3 md:px-4 py-1.5 text-[11px] font-bold text-indigo-600 bg-white border border-indigo-200 rounded-md hover:bg-indigo-50 transition-all uppercase tracking-wider">
                                            <x-lucide-square-pen class="w-4 h-4" />
                                        </a>
                                        <button type="button" wire:click="deleteProduct({{ $product->id }})"
                                            onclick="return confirm('Hapus produk ini?')"
                                            class="inline-flex items-center justify-center px-3 md:px-4 py-1.5 text-[11px] font-bold text-red-600 bg-white border border-red-200 rounded-md hover:bg-red-50 transition-all uppercase tracking-wider">
                                            <x-lucide-trash class="w-4 h-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 md:px-6 py-12 text-center text-gray-400 text-sm italic">Tidak ada
                                    produk
                                    available yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-4 md:px-6 py-4 bg-gray-50 border-t border-gray-100 overflow-x-hidden">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
