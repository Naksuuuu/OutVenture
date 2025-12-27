<div class="p-4 md:p-8 bg-slate-50/50 min-h-screen">
    @if (session('success'))
        <div
            class="fixed bottom-4 md:bottom-10 right-4 md:right-10 p-4 md:p-6 w-fit bg-green-400/90 rounded-lg border border-green-400 mb-2 z-50 shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div
            class="fixed bottom-4 md:bottom-10 right-4 md:right-10 p-4 md:p-6 w-fit bg-red-400/90 rounded-lg border border-red-400 mb-2 z-50 shadow-lg">
            {{ session('error') }}
        </div>
    @endif
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6 mb-6 md:mb-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight uppercase italic">Merek</h2>
            <p class="text-slate-500 mt-1 font-medium">Kelola dan atur identitas merek produk Anda</p>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 md:gap-4 w-full md:w-auto">
            <div class="relative w-full sm:w-48">
                <select wire:model.live="sort"
                    class="w-full pl-4 pr-8 py-2 md:py-3 text-sm border-none rounded-2xl bg-white shadow-sm shadow-slate-200/50 focus:ring-2 focus:ring-emerald-500/20 transition-all font-black uppercase tracking-widest text-slate-700">
                    <option value="latest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                </select>
            </div>

            <div class="relative flex-1 md:w-80 group">
                <span
                    class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                    <x-lucide-search class="w-4 h-4" />
                </span>
                <input type="text" wire:model.live.debounce="search" placeholder="Cari merek..."
                    class="w-full pl-11 pr-4 py-2 md:py-3 text-sm border-none rounded-2xl bg-white shadow-sm shadow-slate-200/50 focus:ring-2 focus:ring-emerald-500/20 transition-all font-medium placeholder:text-slate-400">
            </div>

            <a href="{{ route('admin.brands.create') }}" wire:navigate
                class="flex items-center justify-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white px-4 md:px-6 py-2 md:py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-slate-200 active:scale-95">
                <x-lucide-plus class="w-4 h-4" />
                <span class="hidden sm:inline">Tambah Baru</span>
                <span class="sm:hidden">Tambah</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
        @foreach ($brands as $brand)
            <div
                class="group relative bg-white rounded-[2rem] border border-slate-100 shadow-sm shadow-slate-200/40 hover:shadow-2xl hover:shadow-slate-300/50 transition-all duration-500 overflow-hidden">
                <div
                    class="absolute -right-6 -top-6 text-slate-50/50 group-hover:text-emerald-50 group-hover:rotate-12 transition-all duration-500">
                    <x-lucide-award class="w-32 h-32" />
                </div>

                <div class="relative flex flex-col sm:flex-row items-center p-3 md:p-4 h-auto sm:h-[160px] gap-3 md:gap-6">
                    <div
                        class="w-24 h-24 sm:w-36 sm:h-full bg-slate-50 rounded-[1rem] sm:rounded-[1.5rem] overflow-hidden flex items-center justify-center p-1 relative z-10 transition-transform duration-500 group-hover:scale-[0.98]">
                        @if ($brand->image)
                            <img src="{{ asset('storage/' . $brand->image) }}"
                                class="w-full h-full object-cover rounded-[0.8rem] sm:rounded-[1.2rem] shadow-inner transition duration-500 group-hover:scale-110"
                                alt="{{ $brand->nama_brand }}">
                        @else
                            <div class="flex flex-col items-center justify-center text-slate-300">
                                <x-lucide-image class="w-6 h-6 sm:w-8 sm:h-8 mb-1 opacity-20" />
                                <span class="text-[7px] sm:text-[8px] font-black uppercase tracking-tighter opacity-40">No
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
        @endforeach
    </div>
</div>
