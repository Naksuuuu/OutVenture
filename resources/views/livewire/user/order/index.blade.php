<div class="w-full min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">My Orders</h1>
            <p class="text-gray-600">Track and manage your order history</p>
        </div>

        {{-- Filter Status --}}
        <div class="bg-white rounded-lg shadow-sm mb-6 p-4">
            <div class="flex flex-wrap gap-2">
                <button wire:click="$set('statusFilter', 'all')"
                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $statusFilter === 'all' ? 'bg-black text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All Orders
                </button>
                <button wire:click="$set('statusFilter', 'pending')"
                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $statusFilter === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Pending
                </button>
                <button wire:click="$set('statusFilter', 'success')"
                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $statusFilter === 'success' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Success
                </button>
                <button wire:click="$set('statusFilter', 'failed')"
                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $statusFilter === 'failed' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Failed
                </button>
            </div>
        </div>

        {{-- Orders List --}}
        @if ($orders->count() > 0)
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                        {{-- Order Header --}}
                        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center gap-6">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase font-medium">Order ID</p>
                                        <p class="text-sm font-bold text-gray-900">
                                            #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase font-medium">Date</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $order->tgl_order->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase font-medium">Total</p>
                                        <p class="text-sm font-bold text-gray-900">Rp
                                            {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div>
                                    @if ($order->status_pembayaran === 'pending')
                                        <span
                                            class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending Payment
                                        </span>
                                    @elseif($order->status_pembayaran === 'success')
                                        <span
                                            class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800">
                                            Paid
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800">
                                            Failed
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Order Items --}}
                        <div class="px-6 py-4">
                            <div class="space-y-4">
                                @foreach ($order->items as $item)
                                    <div class="flex gap-4">
                                        {{-- Product Image --}}
                                        <div class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-md overflow-hidden">
                                            <img src="{{ asset('storage/jakettnf.jpg') }}"
                                                alt="{{ $item->variantSpec->variant->product->nama_product }}"
                                                class="w-full h-full object-cover">
                                        </div>

                                        {{-- Product Details --}}
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-sm font-bold text-gray-900 mb-1">
                                                {{ $item->variantSpec->variant->product->nama_product }}
                                            </h3>
                                            <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-600">
                                                <span>Color: <span
                                                        class="font-medium">{{ $item->variantSpec->variant->color->nama_color }}</span></span>
                                                <span>Size: <span
                                                        class="font-medium">{{ $item->variantSpec->size->nama_size }}</span></span>
                                                <span>Qty: <span
                                                        class="font-medium">{{ $item->quantity }}</span></span>
                                            </div>
                                        </div>

                                        {{-- Price --}}
                                        <div class="flex-shrink-0 text-right">
                                            <p class="text-sm font-bold text-gray-900">
                                                Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                @ Rp {{ number_format($item->harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Order Actions --}}
                        <div class="border-t border-gray-200 bg-gray-50 px-6 py-3">
                            <div class="flex justify-end gap-2">
                                @if ($order->status_pembayaran === 'pending')
                                    <button
                                        class="px-4 py-2 text-sm font-medium text-white bg-black rounded-md hover:bg-gray-800 transition-colors">
                                        Pay Now
                                    </button>
                                @endif
                                <button
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No orders found</h3>
                <p class="text-gray-600 mb-6">
                    @if ($statusFilter !== 'all')
                        You don't have any {{ $statusFilter }} orders yet.
                    @else
                        You haven't placed any orders yet. Start shopping now!
                    @endif
                </p>
                <a href="{{ route('products.index') }}" wire:navigate
                    class="inline-block px-6 py-3 bg-black text-white font-medium rounded-md hover:bg-gray-800 transition-colors">
                    Browse Products
                </a>
            </div>
        @endif

    </div>
</div>
