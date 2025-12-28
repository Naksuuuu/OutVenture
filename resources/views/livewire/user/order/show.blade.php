<div class="p-4 md:p-8 lg:p-12">
    <div class="mx-auto">
        <div
            class="bg-white rounded-3xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden">

            <div
                class="glass-header px-8 py-8 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-black rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <x-lucide-receipt class="w-6 h-6 text-white" />
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                            Detail Pesanan</h1>
                        <p class="text-sm text-slate-500 mt-1">Pesanan #{{ $order->id }}</p>
                    </div>
                </div>
                <div>
                    @if ($order->status_pembayaran)
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-emerald-100 text-emerald-800">
                            <x-lucide-check-circle class="w-4 h-4 mr-2" />
                            Lunas
                        </span>
                    @else
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-red-100 text-red-800">
                            <x-lucide-x-circle class="w-4 h-4 mr-2" />
                            Belum Bayar
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-10">

                <section>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-indigo-600 font-bold text-lg">01</span>
                        <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                            Informasi Pelanggan
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                Nama Pelanggan
                            </p>
                            <div
                                class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner">
                                {{ $order->user->nama_lengkap ?? 'N/A' }}
                            </div>
                        </div>

                        <div>
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                Email
                            </p>
                            <div
                                class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner">
                                {{ $order->user->email ?? 'N/A' }}
                            </div>
                        </div>

                        <div>
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                Tanggal Pesanan
                            </p>
                            <div
                                class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner">
                                {{ $order->tgl_order->format('d F Y, H:i') }}
                            </div>
                        </div>

                        <div>
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                Status Pembayaran
                            </p>
                            <div
                                class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner font-semibold">
                                {{ $order->status_pembayaran ? 'Lunas' : 'Belum Bayar' }}
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-indigo-600 font-bold text-lg">02</span>
                        <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                            Item Pesanan
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        @forelse ($order->items as $item)
                            <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm">
                                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-slate-900 mb-2">
                                            {{ $item->variantSpec->variant->product->nama_product ?? 'N/A' }}
                                        </h3>
                                        <div
                                            class="flex flex-wrap gap-x-6 gap-y-2 text-[11px] font-bold uppercase tracking-widest text-slate-400">
                                            <span>Varian: <span class="text-slate-600">Variant</span></span>
                                            <span>Ukuran: <span
                                                    class="text-slate-600">{{ $item->variantSpec->size->size_value ?? 'N/A' }}</span></span>
                                            <span class="flex items-center gap-1.5">
                                                Warna:
                                                @if ($item->variantSpec->variant->color)
                                                    <div class="w-3 h-3 rounded-full border border-slate-200"
                                                        style="background-color: {{ $item->variantSpec->variant->color->color_code }}">
                                                    </div>
                                                    <span
                                                        class="text-slate-600">{{ $item->variantSpec->variant->color->nama_color }}</span>
                                                @else
                                                    <span class="text-slate-600">N/A</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div
                                        class="flex flex-wrap items-center gap-8 lg:gap-12 border-t lg:border-t-0 pt-4 lg:pt-0">
                                        <div>
                                            <p
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                                                Harga Satuan</p>
                                            <p class="text-slate-700 font-semibold text-sm">Rp
                                                {{ number_format($item->harga, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p
                                                class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                                                Jumlah</p>
                                            <p
                                                class="text-slate-900 font-bold bg-slate-50 border border-slate-100 px-3 py-0.5 rounded-lg text-sm inline-block">
                                                {{ $item->quantity }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p
                                                class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider mb-1">
                                                Subtotal</p>
                                            <p class="text-md font-bold text-indigo-600">
                                                Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-ui.empty-state 
                                message="Tidak ada item dalam pesanan ini"
                                class="bg-gray-50 rounded-2xl"
                            />
                        @endforelse
                    </div>

                    <div class="mt-4 flex justify-end">
                        <div class="bg-indigo-600 rounded-2xl px-6 py-3 shadow-md flex items-center gap-4">
                            <span class="text-[10px] font-bold text-indigo-100 uppercase tracking-[0.2em]">Total
                                Bayar</span>
                            <span class="text-lg font-bold text-white leading-none">
                                Rp
                                {{ number_format($order->items->sum(fn($item) => $item->harga * $item->quantity), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-indigo-600 font-bold text-lg">03</span>
                        <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                            Ringkasan Pesanan
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-indigo-50 rounded-2xl p-6 border border-indigo-200">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                                    <x-lucide-shopping-bag class="w-5 h-5 text-white" />
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider">Total Item
                                    </p>
                                    <p class="text-xl font-bold text-indigo-900">{{ $order->items->sum('quantity') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-200">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center">
                                    <x-lucide-package class="w-5 h-5 text-white" />
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Total
                                        Jenis</p>
                                    <p class="text-xl font-bold text-emerald-900">{{ $order->items->count() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-amber-50 rounded-2xl p-6 border border-amber-200">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-amber-600 rounded-xl flex items-center justify-center">
                                    <x-lucide-wallet class="w-5 h-5 text-white" />
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-amber-600 uppercase tracking-wider">Total
                                        Jumlah</p>
                                    <p class="text-xl font-bold text-amber-900">
                                        Rp
                                        {{ number_format($order->items->sum(fn($item) => $item->harga * $item->quantity), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="bg-slate-50/80 px-8 py-6 flex items-center border-t border-slate-100">
                <a href="{{ route('user.orders.index') }}" wire:navigate
                    class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group">
                    <x-lucide-arrow-left class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" />
                    Kembali ke Daftar Pesanan
                </a>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
            &copy; 2025 Praktikum Web &bull; Management System
        </p>
    </div>
</div>
