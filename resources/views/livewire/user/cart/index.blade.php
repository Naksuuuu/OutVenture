<div class="w-full min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Keranjang Belanja</h1>
            <p class="text-gray-600">Kelola produk yang ingin Anda beli.</p>
        </div>

        @if ($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-4">
                    @forelse ($cartItems as $item)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                            <div class="p-6">
                                <div class="flex gap-5 items-start">
                                    {{-- Thumbnail --}}
                                    <div
                                        class="flex-shrink-0 w-24 h-28 bg-[#f2f2ed] rounded-lg overflow-hidden border border-gray-100">
                                        @if ($item->variantSpec->variant->image)
                                            <img src="{{ asset('storage/' . $item->variantSpec->variant->image) }}"
                                                alt="{{ $item->variantSpec->variant->product->nama_product }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>

                                    {{-- Info Produk --}}
                                    <div class="flex-1 min-w-0">
                                        <h3
                                            class="text-base font-bold text-gray-900 mb-2 leading-snug uppercase tracking-tighter">
                                            {{ $item->variantSpec->variant->product->nama_product }}
                                        </h3>
                                        <p class="text-[10px] font-bold text-gray-900 uppercase tracking-widest mb-2">
                                            {{ $item->variantSpec->variant->product->brand->nama_brand ?? 'Brand' }}
                                        </p>
                                        <div class="flex flex-wrap items-center gap-x-3 text-[11px] text-gray-500 mb-3">
                                            <p>Warna: <span
                                                    class="font-semibold text-gray-800">{{ $item->variantSpec->variant->color->nama_warna }}</span>
                                            </p>
                                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                            <p>Ukuran: <span
                                                    class="font-semibold text-gray-800">{{ $item->variantSpec->size->label_size }}</span>
                                            </p>
                                        </div>

                                        {{-- Quantity Controls --}}
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center border border-gray-300 rounded-lg">
                                                <button wire:click="decrementQuantity({{ $item->id }})"
                                                    class="px-3 py-1 hover:bg-gray-50 text-gray-600 font-bold">
                                                    -
                                                </button>
                                                <span class="px-4 py-1 border-x border-gray-300 text-sm font-bold">
                                                    {{ $item->quantity }}
                                                </span>
                                                <button wire:click="incrementQuantity({{ $item->id }})"
                                                    class="px-3 py-1 hover:bg-gray-50 text-gray-600 font-bold">
                                                    +
                                                </button>
                                            </div>
                                            <button wire:click="removeItem({{ $item->id }})"
                                                class="text-[11px] text-red-600 hover:text-red-800 font-bold uppercase">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Harga --}}
                                    <div class="flex-shrink-0 text-right">
                                        <p class="text-base font-bold text-gray-900 mb-1">
                                            {{ Number::currency($item->variantSpec->harga * $item->quantity, 'IDR', 'id', precision: 0) }}
                                        </p>
                                        <p class="text-[10px] text-gray-400 font-medium uppercase tracking-tighter">
                                            @
                                            {{ Number::currency($item->variantSpec->harga, 'IDR', 'id', precision: 0) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-50 rounded-xl p-8 text-center">
                            <p class="text-gray-500">Keranjang kosong</p>
                        </div>
                    @endforelse
                </div>

                {{-- Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-4">
                        <h2 class="text-lg font-bold text-gray-900 mb-4 uppercase tracking-tight">Ringkasan Pesanan</h2>

                        <div class="space-y-3 mb-4 pb-4 border-b border-gray-200">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-bold text-gray-900">
                                    {{ Number::currency($subtotal, 'IDR', 'id', precision: 0) }}
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Ongkir</span>
                                <span class="font-bold text-gray-900">Gratis</span>
                            </div>
                        </div>

                        <div class="flex justify-between mb-6">
                            <span class="text-base font-bold text-gray-900">Total</span>
                            <span class="text-xl font-black text-gray-900">
                                {{ Number::currency($total, 'IDR', 'id', precision: 0) }}
                            </span>
                        </div>

                        <x-ui.loading-button 
                            wire:click="checkout"
                            loading-target="checkout"
                            loading-text="Processing..."
                            class="w-full bg-black text-white py-4 text-[11px] font-bold uppercase tracking-[0.2em] rounded-lg hover:bg-gray-800 transition-all shadow-md active:scale-95">
                            Checkout
                        </x-ui.loading-button>

                        <a href="{{ route('products.index') }}" wire:navigate
                            class="block text-center mt-3 text-[11px] text-gray-600 hover:text-black font-bold uppercase">
                            Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>
        @else
            <x-ui.empty-state 
                full
                icon="shopping-bag"
                title="Keranjang Kosong"
                message="Keranjang belanja Anda masih kosong. Mari jelajahi koleksi terbaik kami dan temukan produk favorit Anda!"
                button-text="Mulai Belanja"
                button-url="{{ route('products.index') }}"
            />
        @endif

    </div>
</div>
