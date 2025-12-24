<div class="w-full px-4 md:px-10 mb-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($brands as $brand)
            <div
                class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:border-emerald-100 transition-all duration-300 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 text-gray-50 group-hover:text-emerald-50 transition-colors">
                    <x-lucide-layers class="w-24 h-24" />
                </div>

                <div class="relative">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-emerald-600 font-bold text-lg group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-inner">
                            <img src="{{ asset('storage/tenda.jpg') }}"
                                class="w-12 h-12 object-cover opacity-80 group-hover:opacity-90 transition duration-300"
                                alt="">
                            {{-- {{ substr($category->nama_category, 0, 1) }} --}}
                            {{-- {{ $category-> image  }} --}}
                        </div>

                        <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            {{-- <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                <x-bxs-edit class="w-4 h-4" />
                            </a>
                            <button wire:click="deleteBrand({{ $brand->id }})" wire:confirm="Hapus brand ini?"
                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <x-eos-delete class="w-4 h-4" />
                            </button> --}}
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">{{ $brand->nama_brand }}
                        </h3>
                        <div class="flex items-center text-gray-500">
                            <x-lucide-shopping-cart class="w-3.5 h-3.5 mr-1.5" />
                            {{-- <span class="text-xs font-medium uppercase tracking-wider">
                                {{ $brand->products_count ?? 0 }} Total Products
                            </span> --}}
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-t border-gray-50">
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            {{-- <div class="bg-emerald-500 h-1.5 rounded-full"
                                style="width: {{ min(($category->products_count ?? 0) * 5, 100) }}%"></div> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
