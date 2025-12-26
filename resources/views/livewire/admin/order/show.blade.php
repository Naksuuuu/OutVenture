<div class="py-12 px-4 sm:px-6">
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
                                {{ $order->user->name ?? 'N/A' }}
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

                    <div class="bg-slate-50 rounded-2xl overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-200">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Produk
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Varian
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Ukuran
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Warna
                                        </th>
                                        <th
                                            class="px-6 py-4 text-center text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Jumlah
                                        </th>
                                        <th
                                            class="px-6 py-4 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Harga
                                        </th>
                                        <th
                                            class="px-6 py-4 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 bg-white">
                                    @foreach ($order->items as $item)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-semibold text-slate-900">
                                                    {{ $item->variantSpec->variant->product->nama_product ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-slate-700">
                                                    Variant
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-slate-700">
                                                    {{ $item->variantSpec->size->size_value ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    @if ($item->variantSpec->variant->color)
                                                        <div class="w-5 h-5 rounded-full border border-slate-300"
                                                            style="background-color: {{ $item->variantSpec->variant->color->color_code }}">
                                                        </div>
                                                        <span
                                                            class="text-sm text-slate-700">{{ $item->variantSpec->variant->color->nama_color }}</span>
                                                    @else
                                                        <span class="text-sm text-slate-700">N/A</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="text-sm font-semibold text-slate-900">
                                                    {{ $item->quantity }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="text-sm text-slate-900">
                                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="text-sm font-bold text-slate-900">
                                                    Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-slate-100">
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-right">
                                            <span class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                                                Total:
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="text-lg font-bold text-indigo-600">
                                                Rp
                                                {{ number_format($order->items->sum(fn($item) => $item->harga * $item->quantity), 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
                                <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center">
                                    <x-lucide-shopping-bag class="w-6 h-6 text-white" />
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-indigo-600 uppercase tracking-wider">
                                        Total Item
                                    </p>
                                    <p class="text-2xl font-bold text-indigo-900">
                                        {{ $order->items->sum('quantity') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-200">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center">
                                    <x-lucide-package class="w-6 h-6 text-white" />
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">
                                        Total Jenis Produk
                                    </p>
                                    <p class="text-2xl font-bold text-emerald-900">{{ $order->items->count() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-amber-50 rounded-2xl p-6 border border-amber-200">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center">
                                    <x-lucide-wallet class="w-6 h-6 text-white" />
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-amber-600 uppercase tracking-wider">
                                        Total Jumlah
                                    </p>
                                    <p class="text-2xl font-bold text-amber-900">
                                        Rp {{ number_format($order->items->sum(fn($item) => $item->harga * $item->quantity), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            <div class="bg-slate-50/80 px-8 py-6 flex items-center border-t border-slate-100">
                <a href="{{ route('admin.orders.index') }}" wire:navigate
                    class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
                    Kembali ke Daftar Pesanan
                </a>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
            &copy; 2025 Praktikum Web &bull; Management System
        </p>
    </div>
</div>
