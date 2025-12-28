<div class="w-full">


    <div class="w-full px-4 md:px-10 pt-0 pb-10 bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <div class="lg:col-span-7">
                <div class="relative bg-[#f2f2ed] aspect-[4/5] w-full overflow-hidden">
                    @if ($this->selectedVariant && $this->selectedVariant->image)
                        <img src="{{ asset('storage/' . $this->selectedVariant->image) }}"
                            alt="{{ $product->nama_product }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <x-lucide-image class="h-24 w-24 text-gray-300" />
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col pt-4 lg:pt-0">
                <span class="text-[12px] font-bold text-black tracking-widest uppercase mb-1">
                    {{ $product->brand->nama_brand ?? 'Brand' }}
                </span>
                <h1 class="text-2xl md:text-3xl font-bold leading-tight text-black mb-4 uppercase tracking-tighter">
                    {{ $product->nama_product }}
                </h1>

                <div class="mb-8 flex flex-col gap-1">
                    <div class="flex items-center gap-2">
                        @if ($this->selectedSpec && $this->selectedSpec->harga)
                            <span class="text-2xl font-bold text-black">
                                {{ Number::currency($this->selectedSpec->harga, 'IDR', 'id', precision: 0) }}
                            </span>
                        @elseif ($this->selectedVariant)
                            <span class="text-2xl font-bold text-black">
                                <span class="text-gray-500 mr-1 font-normal text-base">From</span>
                                {{ Number::currency($this->selectedVariant->specs->min('harga') ?? 0, 'IDR', 'id', precision: 0) }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mb-8">
                    <span class="text-[11px] font-bold uppercase mb-3 block">Variants:
                        <span class="font-normal text-gray-600">
                            {{ $this->selectedVariant->color->nama_warna ?? '' }}
                        </span>
                    </span>
                    <div class="flex gap-2">
                        @forelse ($product->variants as $variant)
                            <button wire:click="selectVariant({{ $variant->id }})"
                                class="w-16 h-20 border-2 p-1 {{ $selectedVariantId == $variant->id ? 'border-black' : 'border-gray-200' }}">
                                @if ($variant->image)
                                    <img src="{{ asset('storage/' . $variant->image) }}"
                                        class="w-full h-full object-cover bg-[#f2f2ed]"
                                        alt="{{ $variant->color->nama_warna }}">
                                @else
                                    <div class="w-full h-full bg-[#f2f2ed] flex items-center justify-center"
                                        style="background-color: {{ $variant->color->hex_code ?? '#f2f2ed' }}">
                                    </div>
                                @endif
                            </button>
                        @empty
                            <p class="col-span-4 text-sm text-gray-500 text-center py-4">Tidak ada ukuran tersedia</p>
                        @endforelse
                    </div>
                </div>

                <div class="mb-8">
                    <span class="text-[11px] font-bold uppercase mb-3 block">Ukuran:
                        @if ($selectedSize && $availableSizes->firstWhere('id', $selectedSize))
                            <span class="font-normal text-gray-600 text-[10px]">
                                {{ $availableSizes->firstWhere('id', $selectedSize)->label_size ?? '' }}
                            </span>
                        @endif
                    </span>
                    <div class="grid grid-cols-4 gap-2">
                        @forelse ($availableSizes as $size)
                            @php
                                $spec = $this->selectedVariant->specs->firstWhere('id_size_value', $size->id);
                                $isOutOfStock = !$spec || ($spec->stok ?? 0) <= 0;
                            @endphp
                            <button wire:click="selectSize({{ $size->id }})"
                                class="relative border border-gray-200 py-3 text-[11px] font-bold hover:border-black transition-colors uppercase
                                {{ $selectedSize == $size->id ? 'border-black bg-black text-white' : '' }}
                                {{ $isOutOfStock ? 'bg-gray-50 text-gray-300' : '' }}"
                                {{ $isOutOfStock ? 'disabled' : '' }}>
                                {{ $size->label_size }}
                                @if ($isOutOfStock)
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-20 h-px bg-gray-900 -rotate-45"></div>
                                    </div>
                                @endif
                            </button>
                        @endforeach
                    </div>


                </div>

                <div class="space-y-3 mb-10">
                    <button wire:click="addToCart"
                        class="w-full bg-black text-white py-5 text-[11px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed"
                        {{ !$selectedSize ? 'disabled' : '' }}>
                        TAMBAHKAN KE KERANJANG
                    </button>
                </div>

                <div class="border-t border-black">
                    <button class="w-full py-4 flex justify-between items-center">
                        <span class="text-[12px] font-bold uppercase tracking-widest">DESCRIPTION</span>
                        <span class="text-xl">—</span>
                    </button>
                    <div class="pb-8">
                        <p class="text-[13px] leading-relaxed text-gray-600 mb-4">
                            <span class="font-bold text-black uppercase">{{ $product->nama_product }}</span><br><br>
                            {{ $product->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
