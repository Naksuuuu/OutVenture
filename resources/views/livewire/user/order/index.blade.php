<div class="w-full min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Pesanan Saya</h1>
            <p class="text-gray-600">Lihat riwayat pesanan Anda.</p>
        </div>

        {{-- Filter Status --}}
        <div class="bg-white rounded-xl shadow-sm mb-6 p-4 border border-gray-100">
            <div class="flex flex-wrap gap-3">
                <button wire:click="$set('statusFilter', 'all')"
                    class="px-5 py-2 rounded-lg text-sm font-bold transition-all {{ $statusFilter === 'all' ? 'bg-black text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua Pesanan
                </button>
                <button wire:click="$set('statusFilter', 'unpaid')"
                    class="px-5 py-2 rounded-lg text-sm font-bold transition-all {{ $statusFilter === 'unpaid' ? 'bg-black text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Harus Bayar
                </button>
                <button wire:click="$set('statusFilter', 'paid')"
                    class="px-5 py-2 rounded-lg text-sm font-bold transition-all {{ $statusFilter === 'paid' ? 'bg-black text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Lunas
                </button>
            </div>
        </div>

        @if ($orders->count() > 0)
            <div class="space-y-6">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">

                        {{-- Order Header --}}
                        <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center gap-8">
                                    <div>
                                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mb-0.5">
                                            Order ID</p>
                                        <p class="text-sm font-bold text-gray-900">
                                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mb-0.5">
                                            Date</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $order->tgl_order->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mb-0.5">
                                            Total</p>
                                        <p class="text-sm font-black text-gray-900">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div>
                                    @php
                                        $isPaid = $order->status_pembayaran == 1;
                                    @endphp
                                    <span
                                        class="px-3 py-1.5 text-[11px] font-black uppercase rounded-md {{ $isPaid ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $isPaid ? 'Lunas' : 'Belum Bayar' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Order Items --}}
                        <div class="px-6 py-5">
                            <div class="space-y-6">
                                @foreach ($order->items as $item)
                                    <div class="flex gap-5 items-start">
                                        {{-- Thumbnail --}}
                                        <div
                                            class="flex-shrink-0 w-20 h-20 bg-gray-50 rounded-lg overflow-hidden border border-gray-100">
                                            <img src="{{ asset('storage/jakettnf.jpg') }}"
                                                alt="{{ $item->variantSpec->variant->product->nama_product }}"
                                                class="w-full h-full object-cover">
                                        </div>

                                        {{-- Info Produk --}}
                                        <div class="flex-1 min-w-0 pt-1">
                                            <h3 class="text-base font-bold text-gray-900 mb-1 leading-snug">
                                                {{ $item->variantSpec->variant->product->nama_product }}
                                            </h3>
                                            <div class="flex flex-wrap items-center gap-x-3 text-[13px] text-gray-500">
                                                <p>Warna: <span
                                                        class="font-semibold text-gray-800">{{ $item->variantSpec->variant->color->nama_warna ?? '-' }}</span>
                                                </p>
                                                <span class="w-1 h-1 bg-gray-300 rounded-full hidden md:block"></span>
                                                <p>Ukuran: <span
                                                        class="font-semibold text-gray-800">{{ $item->variantSpec->size->label_size ?? '-' }}</span>
                                                </p>
                                                <span class="w-1 h-1 bg-gray-300 rounded-full hidden md:block"></span>
                                                <p>Qty: <span
                                                        class="font-semibold text-gray-800">{{ $item->quantity }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Harga Produk --}}
                                        <div class="flex-shrink-0 text-right pt-1">
                                            <p class="text-base font-bold text-gray-900">
                                                Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                            </p>
                                            <p
                                                class="text-[11px] text-gray-400 mt-0.5 font-medium uppercase tracking-tighter">
                                                @ Rp {{ number_format($item->harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Action Footer --}}
                        <div class="border-t border-gray-100 bg-gray-50/30 px-6 py-4">
                            <div class="flex justify-end gap-3">
                                @if ($order->status_pembayaran == 0)
                                    {{-- Belum Bayar - Tombol Pay Now --}}
                                    <button wire:click="payNow({{ $order->id }})" wire:loading.attr="disabled"
                                        class="px-6 py-2.5 text-sm font-bold text-white bg-black rounded-lg hover:bg-gray-800 transition-all shadow-sm active:scale-95 disabled:opacity-50">
                                        <span wire:loading.remove wire:target="payNow">Pay Now</span>
                                        <span wire:loading wire:target="payNow">Processing...</span>
                                    </button>
                                @else
                                    {{-- Lunas - Tombol Download Invoice PDF --}}
                                    <button wire:click="downloadInvoice({{ $order->id }})"
                                        class="px-6 py-2.5 text-sm font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-all shadow-sm active:scale-95">
                                        Download Invoice
                                    </button>
                                @endif
                                <button
                                    class="px-6 py-2.5 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all shadow-sm active:scale-95">
                                    View Details
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-2xl shadow-sm p-16 text-center border border-gray-100">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-full mb-6">
                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada pesanan</h3>
                <p class="text-gray-500 max-w-sm mx-auto mb-8 text-sm">
                    @if ($statusFilter !== 'all')
                        Anda tidak memiliki pesanan dengan status <strong>{{ $statusFilter }}</strong> saat ini.
                    @else
                        Sepertinya Anda belum melakukan pemesanan apapun. Mari jelajahi koleksi terbaik kami!
                    @endif
                </p>
                <a href="{{ route('products.index') }}" wire:navigate
                    class="inline-block px-8 py-3 bg-black text-white font-bold rounded-lg hover:bg-gray-800 transition-all shadow-lg hover:shadow-black/20">
                    Mulai Belanja
                </a>
            </div>
        @endif

    </div>
</div>

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('open-payment', (event) => {
                const snapToken = event.snapToken;

                if (!snapToken) {
                    alert('Snap token tidak ditemukan!');
                    return;
                }

                window.snap.pay(snapToken, {
                    onSuccess: function(result) {
                        console.log('Payment success:', result);
                        window.location.href =
                            '{{ route('user.orders.index') }}?payment=success';
                    },
                    onPending: function(result) {
                        console.log('Payment pending:', result);
                        window.location.href =
                            '{{ route('user.orders.index') }}?payment=pending';
                    },
                    onError: function(result) {
                        console.log('Payment error:', result);
                        alert('Pembayaran gagal, silakan coba lagi');
                    },
                    onClose: function() {
                        console.log('Payment popup closed');
                    }
                });
            });
        });
    </script>
@endpush
