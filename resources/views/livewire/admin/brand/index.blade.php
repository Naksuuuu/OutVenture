<div>
    <x-ui.page-header
        title="Merek"
        subtitle="Kelola dan atur identitas merek produk Anda"
        class="lg:items-center mb-6 md:mb-10"
    >
        <x-slot:actions>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 md:gap-4 w-full md:w-auto">
                <livewire:ui.dropdown
                    wire:model.live="sort"
                    :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']"
                    width="w-full sm:w-48"
                />

                <x-ui.search-input model="search" placeholder="Cari merek..." width="md:w-80" class="pl-11 focus:ring-emerald-500/20" />

                <a href="{{ route('admin.brands.create') }}" wire:navigate
                    class="flex items-center justify-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white px-4 md:px-6 py-2 md:py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-slate-200 active:scale-95">
                    <x-lucide-plus class="w-4 h-4" />
                    <span class="hidden sm:inline">Tambah Baru</span>
                    <span class="sm:hidden">Tambah</span>
                </a>
            </div>
        </x-slot:actions>
    </x-ui.page-header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-4 md:gap-6 lg:gap-8">
        @forelse ($brands as $brand)
            <div
                class="group relative bg-white rounded-[2rem] border border-slate-100 shadow-sm shadow-slate-200/40 hover:shadow-2xl hover:shadow-slate-300/50 transition-all duration-500 overflow-hidden">
                <div
                    class="absolute -right-6 -top-6 text-slate-50/50 group-hover:text-emerald-50 group-hover:rotate-12 transition-all duration-500">
                    <x-lucide-award class="w-32 h-32" />
                </div>

                <div
                    class="relative flex flex-col sm:flex-row items-center p-3 md:p-4 h-auto sm:h-[160px] gap-3 md:gap-6">
                    <div
                        class="w-24 h-24 sm:w-36 sm:h-full bg-slate-50 rounded-[1rem] sm:rounded-[1.5rem] overflow-hidden flex items-center justify-center p-1 relative z-10 transition-transform duration-500 group-hover:scale-[0.98]">
                        @if ($brand->image)
                            <img src="{{ asset('storage/' . $brand->image) }}"
                                class="w-full h-full object-cover rounded-[0.8rem] sm:rounded-[1.2rem] shadow-inner transition duration-500 group-hover:scale-110"
                                alt="{{ $brand->nama_brand }}">
                        @else
                            <div class="flex flex-col items-center justify-center text-slate-300">
                                <x-lucide-image class="w-6 h-6 sm:w-8 sm:h-8 mb-1 opacity-20" />
                                <span
                                    class="text-[7px] sm:text-[8px] font-black uppercase tracking-tighter opacity-40">No
                                    Image</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 flex flex-col justify-center relative z-10 text-center sm:text-left">
                        <a href="{{ route('admin.brands.show', $brand->id) }}" wire:navigate
                            class="text-lg sm:text-xl font-black text-slate-800 mb-2 leading-tight hover:text-emerald-600 transition-colors uppercase italic tracking-tight">
                            {{ $brand->nama_brand }}
                        </a>

                        <div class="space-y-1.5">
                            <div class="flex items-center justify-center sm:justify-start text-slate-400">
                                <x-lucide-handbag class="w-3.5 h-3.5 mr-2 text-slate-300" />
                                <span class="text-[10px] font-black uppercase tracking-widest">
                                    {{ $brand->products_count ?? 0 }} Produk
                                </span>
                            </div>

                            @if ($brand->is_trusted)
                                <div
                                    class="flex items-center justify-center sm:justify-start text-emerald-500 inline-flex px-2 py-0.5 bg-emerald-50 rounded-full w-fit border border-emerald-100/50">
                                    <x-lucide-badge-check class="w-3 h-3 mr-1.5 shadow-sm" />
                                    <span class="text-[9px] font-black uppercase tracking-wider">
                                        Terpercaya
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div
                            class="flex items-center justify-center sm:justify-start mt-4 gap-1 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                            <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all active:scale-90">
                                <x-lucide-square-pen class="w-5 h-5" />
                            </a>
                            <livewire:admin.brand.delete :brand="$brand->id" :key="'brand-delete-' . $brand->id" />
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl p-16 text-center border border-dashed border-gray-300">
                <x-lucide-package-open class="w-16 h-16 mx-auto text-gray-300 mb-4" />
                <p class="text-gray-500 font-medium">Belum ada brand</p>
                <p class="text-sm text-gray-400 mt-2">Klik tombol "Tambah Brand" untuk membuat brand baru</p>
            </div>
        @endforelse
    </div>
</div>
