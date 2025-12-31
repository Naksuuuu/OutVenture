<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.orders.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>

    <div class="mx-auto">

        <x-ui.card-item class="overflow-hidden" rounded="rounded-[2.5rem]" shadow="shadow-xl shadow-slate-200/50"
            border="border border-slate-100">

            <x-slot:header class="px-10 py-10 ">
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div
                            class="w-16 h-16 bg-black rounded-2xl flex items-center justify-center shadow-lg  rotate-3 transition-transform hover:rotate-0">
                            <x-lucide-receipt class="w-8 h-8 text-white" />
                        </div>
                        <div>
                            <h1 class="text-3xl font-black tracking-tight uppercase italic">Detail Pesanan</h1>
                            <p class="font-bold mt-1 tracking-wider uppercase text-xs">
                                #{{ $order->id }}
                            </p>
                        </div>
                    </div>

                    <div>
                        @if ($order->status_pembayaran)
                            <span
                                class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl font-black text-[10px] uppercase tracking-widest border border-emerald-100 shadow-sm">
                                <x-lucide-check-circle class="w-4 h-4" />
                                Lunas
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-2 bg-red-50 text-red-500 px-4 py-2 rounded-xl font-black text-[10px] uppercase tracking-widest border border-red-100 shadow-sm">
                                <x-lucide-x-circle class="w-4 h-4" />
                                Belum Bayar
                            </span>
                        @endif
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <div class="flex flex-col gap-12">
                        <!-- Section 1: Informasi Pelanggan -->
                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-black text-white flex items-center justify-center font-black text-sm">01</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Informasi Pelanggan</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="group">
                                    <x-ui.form.label label="Nama Pelanggan" />
                                    <x-ui.form.input value="{{ $order->user->nama_lengkap ?? 'N/A' }}" readonly />
                                </div>
                                <div class="group">
                                    <x-ui.form.label label="Email" />
                                    <x-ui.form.input value="{{ $order->user->email ?? 'N/A' }}" readonly />
                                </div>
                                <div class="group">
                                    <x-ui.form.label label="Tanggal Pesanan" />
                                    <x-ui.form.input value="{{ $order->tgl_order->format('d F Y, H:i') }}" readonly />
                                </div>
                                <div class="group">
                                    <x-ui.form.label label="Status Pembayaran" />
                                    <x-ui.form.input value="{{ $order->status_pembayaran ? 'Lunas' : 'Belum Bayar' }}"
                                        readonly
                                        class="{{ $order->status_pembayaran ? 'text-emerald-600' : 'text-red-500' }} font-bold" />
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Item Pesanan -->
                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-black text-white flex items-center justify-center font-black text-sm">02</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Item Pesanan</h2>
                            </div>

                            <div class="space-y-4">
                                @forelse ($order->items as $item)
                                    <div
                                        class="bg-white border border-slate-100 rounded-4xl p-6 shadow-sm hover:border-indigo-100 hover:shadow-md transition-all">
                                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                                            <div class="flex-1">
                                                <h3 class="text-lg font-bold text-slate-900 mb-2">
                                                    {{ $item->variantSpec->variant->product->nama_product ?? 'N/A' }}
                                                </h3>
                                                <div
                                                    class="flex flex-wrap gap-x-6 gap-y-2 text-[11px] font-bold uppercase tracking-widest text-slate-400">
                                                    <span class="flex items-center gap-1.5">
                                                        Brand:
                                                        <span
                                                            class="text-slate-600">{{ $item->variantSpec->variant->product->brand->nama_brand ?? 'N/A' }}</span>
                                                    </span>
                                                    <span class="flex items-center gap-1.5">
                                                        Ukuran:
                                                        <span
                                                            class="text-slate-600">{{ $item->variantSpec->size->label_size ?? 'N/A' }}</span>
                                                    </span>
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
                                                        Harga</p>
                                                    <p class="text-slate-700 font-bold text-sm">Rp
                                                        {{ number_format($item->harga, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p
                                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                                                        Qty</p>
                                                    <p
                                                        class="text-slate-900 font-bold bg-slate-50 border border-slate-100 px-3 py-1 rounded-lg text-sm inline-block">
                                                        {{ $item->quantity }}
                                                    </p>
                                                </div>
                                                <div class="text-right min-w-[120px]">
                                                    <p
                                                        class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider mb-1">
                                                        Subtotal</p>
                                                    <p class="text-lg font-black text-indigo-600">
                                                        Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div
                                        class="bg-slate-50 rounded-2xl p-8 text-center border-2 border-dashed border-slate-200">
                                        <p class="text-slate-400 font-medium italic">Tidak ada item dalam pesanan ini</p>
                                    </div>
                                @endforelse

                                <div class="mt-6 flex justify-end">
                                    <div
                                        class="bg-slate-900 rounded-2xl px-8 py-4 shadow-xl shadow-slate-200 flex items-center gap-6">
                                        <span
                                            class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Total
                                            Bayar</span>
                                        <span class="text-2xl font-black text-white leading-none">
                                            Rp
                                            {{ number_format($order->items->sum(fn($item) => $item->harga * $item->quantity), 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Ringkasan Pesanan -->
                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-black text-white flex items-center justify-center font-black text-sm">03</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Ringkasan Pesanan</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-indigo-50 rounded-4xl p-6 border border-indigo-100">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                                            <x-lucide-shopping-bag class="w-6 h-6 text-white" />
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider">
                                                Total Item</p>
                                            <p class="text-2xl font-black text-indigo-900">
                                                {{ $order->items->sum('quantity') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-emerald-50 rounded-4xl p-6 border border-emerald-100">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200">
                                            <x-lucide-package class="w-6 h-6 text-white" />
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider">
                                                Total Jenis</p>
                                            <p class="text-2xl font-black text-emerald-900">{{ $order->items->count() }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-amber-50 rounded-4xl p-6 border border-amber-100">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-200">
                                            <x-lucide-wallet class="w-6 h-6 text-white" />
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-amber-500 uppercase tracking-wider">
                                                Total Nilai</p>
                                            <p class="text-2xl font-black text-amber-900">
                                                Rp
                                                {{ number_format($order->items->sum(fn($item) => $item->harga * $item->quantity), 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>

        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.orders.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>
</div>