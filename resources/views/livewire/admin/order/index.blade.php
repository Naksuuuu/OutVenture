<div>
    <x-ui.page-header title="Pesanan" subtitle="Lihat dan kelola semua pesanan pelanggan"
        class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>

            <button wire:click="downloadAllInvoices" wire:loading.attr="disabled"
                class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl transition-all shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                <x-lucide-download class="w-4 h-4 mr-2" />
                <span wire:loading.remove wire:target="downloadAllInvoices">Invoice</span>
                <span wire:loading wire:target="downloadAllInvoices">Generating...</span>
            </button>

            <livewire:ui.dropdown wire:model.live="sortBy" :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']" width="w-full sm:w-40" />

            <livewire:ui.dropdown wire:model.live="status" :options="['all' => 'Semua Status', 'lunas' => 'Lunas', 'belum_bayar' => 'Belum Bayar']" width="w-full sm:w-48" />


            <x-ui.search-input model="search" placeholder="Cari produk..." width="" />

            <x-ui.button.create size="size-4" href="{{ route('admin.products.create') }}" label="Tambah" />
        </x-slot:actions>
    </x-ui.page-header>

    {{-- Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($orders as $order)
            <x-ui.card-item
                class="flex flex-col justify-between gap-4 bg-white rounded-2xl shadow-sm border border-gray-200 p-3 hover:shadow-md transition-all ">
                <x-slot:header class="flex justify-between w-full items-start mb-4">
                    <span class="text-sm font-bold text-gray-900 bg-gray-100 px-3 py-1 rounded-lg">
                        #{{ $order->id }}
                    </span>

                    @if ($order->status_pembayaran)
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                            <x-lucide-check-circle class="w-3 h-3 mr-1" />
                            Lunas
                        </span>
                    @else
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                            <x-lucide-x-circle class="w-3 h-3 mr-1" />
                            Belum Bayar
                        </span>
                    @endif
                </x-slot:header>

                <x-slot>
                    <div class="flex flex-col gap-4">
                        <div class="">
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Pelanggan</p>
                            <h4 class="text-sm font-bold text-gray-900">{{ $order->user->nama_lengkap ?? 'N/A' }}</h4>
                            <p class="text-xs text-gray-500">{{ $order->user->email ?? 'N/A' }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Tanggal</p>
                                <p class="text-sm text-gray-900 font-medium">{{ $order->tgl_order->format('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $order->tgl_order->format('H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Total Item</p>
                                <p class="text-sm text-gray-900 font-bold">{{ $order->items->sum('quantity') }} items
                                </p>
                            </div>
                        </div>
                    </div>

                </x-slot>

                <x-slot:footer class="mt-0! border-t border-gray-100 flex items-end justify-between">
                    <div class="mt-2">
                        <p class="text-xs text-gray-400 font-medium uppercase">Total Harga</p>
                        <p class="text-lg font-black text-gray-900 leading-none">
                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </p>
                    </div>

                    <x-ui.button.show href="{{ route('admin.orders.show', $order) }}" label="Lihat Detail"
                        size='size-4' />

                </x-slot:footer>
            </x-ui.card-item>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-gray-300 py-20 text-center">
                <div class="flex flex-col items-center justify-center">
                    <x-lucide-package-open class="w-16 h-16 text-gray-300 mb-4" />
                    <p class="text-gray-500 font-medium">Tidak ada pesanan</p>
                    <p class="text-sm text-gray-400 mt-1">Pesanan akan muncul di sini ketika pelanggan melakukan
                        pembelian</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($orders->hasPages())
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @endif
</div>
