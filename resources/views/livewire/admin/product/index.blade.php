<div class=" min-h-screen">

    <div class="mx-auto">
        <x-ui.page-header
            title="Manajemen Produk"
            :subtitle="'Total ' . ($totalProducts ?? $products->count()) . ' produk di database.'"
            class="md:items-center"
        >
            <x-slot:actions>
                <div class="flex flex-col md:flex-row items-start md:items-center gap-3 w-full md:w-auto">
                    <livewire:ui.dropdown
                        wire:model.live="sort"
                        :options="['terbaru' => 'Terbaru', 'terlama' => 'Terlama']"
                        width="w-full md:w-auto"
                    />

                    <x-ui.search-input model="search" placeholder="Cari produk..." width="md:w-64" class="border-gray-100 text-indigo-700 focus:ring-indigo-500" />

                    <a href="{{ route('admin.products.create') }}" wire:navigate
                        class="flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 md:px-5 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-sm w-full md:w-auto">
                        <x-lucide-plus class="w-5 h-5" />
                        Tambah Produk
                    </a>
                </div>
            </x-slot:actions>
        </x-ui.page-header>

        <x-ui.card-item rounded="rounded-xl" class="overflow-hidden">
            <!-- Mobile Card View -->
            <div class="block md:hidden">
                <div class="divide-y divide-gray-100">
                    @forelse ($products as $product)
                        <div class="p-4 hover:bg-gray-50/50 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex-1">
                                    <span
                                        class="text-sm font-bold text-gray-800 tracking-tight leading-tight">{{ $product->nama_product }}</span>
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
                                    @livewire('admin.product.delete', ['product' => $product->id], key('delete-mobile-' . $product->id))
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
                            <th
                                class="w-[40%] px-4 md:px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                Informasi
                                Produk</th>
                            <th
                                class="w-[20%] px-4 md:px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                Merek
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
                                        @livewire('admin.product.delete', ['product' => $product->id], key('delete-desktop-' . $product->id))
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 md:px-6 py-12 text-center text-gray-400 text-sm italic">
                                    Tidak ada
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
        </x-ui.card-item>
    </div>
</div>
