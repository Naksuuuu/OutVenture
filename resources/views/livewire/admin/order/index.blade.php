<div>
    {{-- Header & Filters --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Manajemen Pesanan</h2>
            <p class="text-gray-500 mt-1 text-sm">Lihat dan kelola semua pesanan pelanggan</p>
        </div>

        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <button wire:click="downloadAllInvoices" wire:loading.attr="disabled"
                class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl transition-all shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                <x-lucide-download class="w-4 h-4 mr-2" />
                <span wire:loading.remove wire:target="downloadAllInvoices">Download Semua Invoice</span>
                <span wire:loading wire:target="downloadAllInvoices">Generating...</span>
            </button>

            <div class="relative flex-1 min-w-[250px] md:w-80">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <x-lucide-search class="w-4 h-4" />
                </span>
                <input type="text" wire:model.live.debounce="search"
                    placeholder="Cari berdasarkan ID atau pelanggan..."
                    class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white shadow-sm transition-all">
            </div>

            <div class="relative w-full sm:w-40">
                <select wire:model.live="sortBy"
                    class="w-full pl-3 pr-8 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white shadow-sm font-semibold text-gray-700">
                    <option value="latest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                </select>
            </div>

            <div class="relative w-full sm:w-48">
                <select wire:model.live="status"
                    class="w-full pl-3 pr-8 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white shadow-sm font-semibold text-gray-700">
                    <option value="all">Semua Status</option>
                    <option value="lunas">Lunas</option>
                    <option value="belum_bayar">Belum Bayar</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($orders as $order)
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    {{-- ID & Status --}}
                    <div class="flex justify-between items-start mb-4">
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
                    </div>

                    {{-- Pelanggan --}}
                    <div class="mb-4">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Pelanggan</p>
                        <h4 class="text-sm font-bold text-gray-900">{{ $order->user->nama_lengkap ?? 'N/A' }}</h4>
                        <p class="text-xs text-gray-500">{{ $order->user->email ?? 'N/A' }}</p>
                    </div>

                    {{-- Tanggal & Item --}}
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Tanggal</p>
                            <p class="text-sm text-gray-900 font-medium">{{ $order->tgl_order->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $order->tgl_order->format('H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Total Item</p>
                            <p class="text-sm text-gray-900 font-bold">{{ $order->items->sum('quantity') }} items</p>
                        </div>
                    </div>
                </div>

                {{-- Harga & Aksi --}}
                <div class="pt-5 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 font-medium uppercase">Total Harga</p>
                        <p class="text-lg font-black text-gray-900 leading-none">
                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </p>
                    </div>

                    <a href="{{ route('admin.orders.show', $order->id) }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                        <x-lucide-eye class="w-4 h-4 mr-1.5" />
                        Lihat Detail
                    </a>
                </div>
            </div>
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
