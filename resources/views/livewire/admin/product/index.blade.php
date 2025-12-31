<div class="mx-auto">

    <x-ui.page-header title="Produk" :subtitle="'Total ' . ($totalProducts ?? $products->count()) . ' produk di database.'" class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>
            <livewire:ui.dropdown wire:model.live="sort" :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']"
                class="" />
            <livewire:ui.dropdown wire:model.live="category" :options="$allCategories" class="" />


            <x-ui.search-input model="search" placeholder="Cari produk..." width="" />

            <x-ui.link href="{{ route('admin.products.create') }}" label="Tambah" icon="plus" variant="create" />
        </x-slot:actions>
    </x-ui.page-header>


    <x-ui.card-item class="rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 {{ $products->hasPages() ? '' : 'hidden' }}">
            {{ $products->links('components.ui.pagination') }}
        </div>

        <!-- Mobile Card View -->
        <div class="block md:hidden">
            <div class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    <div class="p-5 hover:bg-gray-50/50 transition-all group">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1 min-w-0 pr-4">
                                <h3 class="text-sm font-bold text-slate-800 line-clamp-2 leading-snug mb-1">
                                    {{ $product->nama_product }}
                                </h3>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide bg-slate-100 text-slate-500 border border-slate-200">
                                        {{ $product->brand->nama_brand ?? 'No Brand' }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide {{ $product->category ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-50 text-slate-400 border border-slate-100' }}">
                                        {{ $product->category->nama_category ?? 'No Category' }}
                                    </span>
                                </div>
                                <div class="mt-2 flex items-center gap-1">
                                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total
                                        Variant:</span>
                                    <span class="text-xs font-bold text-slate-700">{{ $product->variants->count() }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 pt-3 border-t border-dashed border-slate-100 mt-3">
                            <x-ui.link href="{{ route('admin.products.show', $product) }}" icon="eye" variant="show"
                                size="md" />
                            <x-ui.link href="{{ route('admin.products.edit', $product) }}" icon="square-pen" size="md"
                                variant="edit" />
                            <x-ui.button variant="delete" size="icon-md" icon="trash"
                                @click="$dispatch('open-delete-modal', { id: {{ $product->id }} })" />
                        </div>
                    </div>
                @empty
                    <x-ui.empty-state icon="package-open" title="Produk Kosong"
                        message="Belum ada produk yang sesuai filter" />
                @endforelse
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <x-ui.table>
                <x-ui.table.head>
                    <x-ui.table.row>
                        <x-ui.table.heading class="w-fit">No</x-ui.table.heading>
                        <x-ui.table.heading class="w-[30%]">Nama Produk</x-ui.table.heading>
                        <x-ui.table.heading class="text-center w-[15%]">Brand</x-ui.table.heading>
                        <x-ui.table.heading class="text-center w-[15%]">Kategori</x-ui.table.heading>
                        <x-ui.table.heading class="text-center w-[15%]">Total Variant</x-ui.table.heading>
                        <x-ui.table.heading class="text-center w-[15%]">Aksi</x-ui.table.heading>
                    </x-ui.table.row>
                </x-ui.table.head>
                <x-ui.table.body>
                    @forelse ($products as $product)
                        <x-ui.table.row>
                            <x-ui.table.cell>{{ $loop->iteration }}</x-ui.table.cell>
                            <x-ui.table.cell>
                                <div class="flex items-start gap-4">
                                    <div>
                                        <h3
                                            class="text-sm font-bold text-slate-800 line-clamp-2 mb-0.5 group-hover:text-rose-600 transition-colors">
                                            {{ $product->nama_product }}
                                        </h3>
                                    </div>
                                </div>
                            </x-ui.table.cell>
                            <x-ui.table.cell class="text-center">
                                <span
                                    class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1 rounded-lg border border-slate-200">
                                    {{ $product->brand->nama_brand ?? '-' }}
                                </span>
                            </x-ui.table.cell>
                            <x-ui.table.cell class="text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide {{ $product->category ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-50 text-slate-400 border border-slate-100' }}">
                                    {{ $product->category->nama_category ?? 'Uncategorized' }}
                                </span>
                            </x-ui.table.cell>
                            <x-ui.table.cell class="text-center">
                                <div class="flex flex-col items-center gap-1">
                                    <span class="text-xs font-bold text-slate-700">{{ $product->variants->count() }}</span>
                                </div>
                            </x-ui.table.cell>
                            <x-ui.table.cell class="text-right">
                                <div class="flex justify-end gap-2">
                                    <x-ui.link href="{{ route('admin.products.show', $product) }}" icon="eye" variant="show"
                                        size="sm" class="!p-2.5" />
                                    <x-ui.link href="{{ route('admin.products.edit', $product) }}" icon="square-pen"
                                        size="sm" variant="edit" class="!p-2.5" />
                                    <x-ui.button variant="delete" size="icon-sm" icon="trash"
                                        @click="$dispatch('open-delete-modal', { id: {{ $product->id }} })"
                                        class="!p-2.5" />
                                </div>
                            </x-ui.table.cell>
                        </x-ui.table.row>
                    @empty
                        <x-ui.table.row>
                            <x-ui.table.cell colspan="6">
                                <x-ui.empty-state full icon="package-open" title="Tidak ada Produk"
                                    message="Belum ada produk. Tambahkan produk baru untuk mengatur produk."
                                    shadow="shadow-none" border="border-0" rounded="rounded-2xl" buttonText="Buat Produk"
                                    buttonUrl="{{ route('admin.products.create') }}" />
                            </x-ui.table.cell>
                        </x-ui.table.row>
                    @endforelse
                </x-ui.table.body>
            </x-ui.table>
        </div>

        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
            {{ $products->links('components.ui.pagination') }}
        </div>
    </x-ui.card-item>

    <x-ui.modal.delete title="Hapus Produk?" message="Yakin ingin menghapus produk ini? Data tidak bisa dikembalikan."
        :errorMessage="$errorMessage" />
</div>