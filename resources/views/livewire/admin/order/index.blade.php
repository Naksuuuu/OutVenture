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

            <livewire:ui.dropdown wire:model.live="sortBy" :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']"
                width="w-full sm:w-40" />

            <livewire:ui.dropdown wire:model.live="status" :options="['all' => 'Semua Status', 'lunas' => 'Lunas', 'belum_bayar' => 'Belum Bayar']" width="w-full sm:w-48" />


            <x-ui.search-input model="search" placeholder="Cari ID Pesanan, Nama, Email..." width="" />

            {{-- Removed irrelevant "Create Product" button --}}
        </x-slot:actions>
    </x-ui.page-header>

    {{-- Desktop Table --}}
    <x-ui.card-item class="hidden md:block overflow-hidden" >

        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 {{ $orders->hasPages() ? '' : 'hidden' }}">
            {{ $orders->links('components.ui.pagination') }}
        </div>  

        <x-ui.table>
            <x-ui.table.head>
                <x-ui.table.row>
                    <x-ui.table.heading class="w-fit">No</x-ui.table.heading>
                    <x-ui.table.heading>ID Order</x-ui.table.heading>
                    <x-ui.table.heading class="w-[30%]">Pelanggan</x-ui.table.heading>
                    <x-ui.table.heading>Tanggal</x-ui.table.heading>
                    <x-ui.table.heading class="text-center">Status</x-ui.table.heading>
                    <x-ui.table.heading class="text-right">Total</x-ui.table.heading>
                    <x-ui.table.heading class="text-center">Aksi</x-ui.table.heading>
                </x-ui.table.row>
            </x-ui.table.head>
            <x-ui.table.body>
                @forelse ($orders as $order)
                    <x-ui.table.row>
                        <x-ui.table.cell>{{ $loop->iteration }}</x-ui.table.cell>
                        <x-ui.table.cell>
                            <span class="font-mono text-xs font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded">#{{ $order->id }}</span>
                        </x-ui.table.cell>
                        <x-ui.table.cell>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500 shrink-0">
                                    {{ substr($order->user->nama_lengkap ?? '?', 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-slate-800 line-clamp-1">{{ $order->user->nama_lengkap ?? 'N/A' }}</h4>
                                    <p class="text-[11px] text-slate-400 line-clamp-1">{{ $order->user->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </x-ui.table.cell>
                        <x-ui.table.cell>
                            <span class="text-sm text-slate-600 font-medium">{{ $order->tgl_order->format('d M Y') }}</span>
                        </x-ui.table.cell>
                        <x-ui.table.cell class="text-center">
                            @if ($order->status_pembayaran)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide bg-emerald-50 text-emerald-600 border border-emerald-100">
                                    Lunas
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide bg-red-50 text-red-600 border border-red-100">
                                    Belum Bayar
                                </span>
                            @endif
                        </x-ui.table.cell>
                        <x-ui.table.cell class="text-right">
                            <span class="text-sm font-bold text-slate-700">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </x-ui.table.cell>
                        <x-ui.table.cell class="text-center">
                            <x-ui.link href="{{ route('admin.orders.show', $order) }}" icon="eye" variant="show" size="md" class="!p-2" />
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @empty
                    <x-ui.table.row>
                        <x-ui.table.cell colspan="7">
                            <x-ui.empty-state
                                icon="package-open"
                                title="Belum ada pesanan"
                                message="Pesanan akan muncul di sini"
                                class="py-8"
                            />
                        </x-ui.table.cell>
                    </x-ui.table.row>
                @endforelse
            </x-ui.table.body>
        </x-ui.table>

        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 ">
            {{ $orders->links('components.ui.pagination') }}
        </div>
    </x-ui.card-item>

    {{-- Mobile Cards Grid --}}
    <div class="grid grid-cols-1 md:hidden gap-6">
        @forelse ($orders as $order)
            <x-ui.card-item
                class="group justify-self-center flex flex-col justify-between h-[450px] w-full max-w-xl p-3 transition-all duration-300"
                rounded="rounded-2xl" hover="hover:shadow-lg hover:-translate-y-2">

                <x-slot:header
                    class="w-full h-2/5 bg-indigo-50/50 rounded-2xl overflow-hidden flex items-center justify-center border border-indigo-100/50 group-hover:bg-indigo-50 transition-colors relative">
                    <div class="absolute top-3 right-3">
                        @if ($order->status_pembayaran)
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-emerald-100/80 text-emerald-700 backdrop-blur-sm shadow-sm border border-emerald-200">
                                Lunas
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-red-100/80 text-red-700 backdrop-blur-sm shadow-sm border border-red-200">
                                Belum Bayar
                            </span>
                        @endif
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        <div class="p-3 bg-white rounded-xl shadow-sm border border-indigo-100">
                            <x-lucide-receipt class="w-8 h-8 text-indigo-500" />
                        </div>
                        <span class="text-sm font-black text-indigo-900">#{{ $order->id }}</span>
                    </div>
                </x-slot:header>

                <x-slot>
                    <div class="rounded-b-2xl h-3/5 pt-4 pb-2 px-2 flex flex-col justify-between">
                        <div class="space-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pelanggan</p>
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500">
                                        {{ substr($order->user->nama_lengkap ?? '?', 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-slate-800 line-clamp-1">
                                            {{ $order->user->nama_lengkap ?? 'N/A' }}</h4>
                                        <p class="text-[10px] font-bold text-slate-400 line-clamp-1">
                                            {{ $order->user->email ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <div class="bg-slate-50 p-2 rounded-xl border border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Tanggal
                                    </p>
                                    <p class="text-xs font-bold text-slate-700">{{ $order->tgl_order->format('d M Y') }}</p>
                                </div>
                                <div class="bg-slate-50 p-2 rounded-xl border border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Total
                                    </p>
                                    <p class="text-xs font-bold text-slate-700">Rp
                                        {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mt-auto">
                            <x-ui.link href="{{ route('admin.orders.show', $order) }}" label="Lihat Detail" icon="eye"
                                variant="show" size="md" class="w-full justify-center" />
                        </div>
                    </div>
                </x-slot>
            </x-ui.card-item>
        @empty
            <x-ui.empty-state
                full
                icon="package-open"
                title="Belum ada pesanan"
                message="Pesanan akan muncul di sini ketika pelanggan melakukan pembelian"
            />
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 ">
        {{ $orders->links('components.ui.pagination') }}
    </div>
</div>