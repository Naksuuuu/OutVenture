<div class="bg-gray-50 min-h-screen p-8">

    {{-- Modal Pop-up Notifikasi Success/Error --}}
    @if ($successMessage || $errorMessage)
        <div x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => { show = false; @this.call('resetMessages'); }, 3000)"
            @click="if($event.target === $el) { show = false; @this.call('resetMessages'); }"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[9999] flex items-center justify-center p-4">
            
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm"></div>

            <!-- Modal Content -->
            <div class="relative z-[10000] w-full max-w-sm bg-white rounded-2xl shadow-2xl border border-slate-100 p-8 space-y-4">
                <div class="flex items-center justify-center mb-4">
                    @if ($successMessage)
                        <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    @else
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <div class="text-center">
                    <h3 class="text-xl font-bold {{ $successMessage ? 'text-green-600' : 'text-red-600' }} mb-2">
                        {{ $successMessage ? 'Berhasil!' : 'Gagal!' }}
                    </h3>
                    <p class="text-slate-600 text-sm">
                        {{ $successMessage ?: $errorMessage }}
                    </p>
                </div>

                <div class="flex items-center justify-center pt-4">
                    <button @click="show = false; @this.call('resetMessages')"
                        class="text-xs font-bold text-slate-500 uppercase tracking-widest hover:text-slate-700 transition-colors px-6 py-2 rounded-lg hover:bg-slate-50">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Manajemen Warna</h2>
                <p class="text-sm text-gray-500 mt-1">Total {{ $totalColors }} warna di database.</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-indigo-500">
                        <x-lucide-search class="w-5 h-5" />
                    </span>
                    <input type="text" wire:model.live.debounce="search" placeholder="Cari warna..."
                        class="w-full md:w-64 pl-10 pr-4 py-2.5 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white text-indigo-700 shadow-sm">
                </div>

                <a href="{{ route('admin.colors.create') }}" wire:navigate
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-md active:scale-95">
                    <x-lucide-plus class="w-5 h-5" />
                    Tambah Warna
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($colors as $color)
                <div class="bg-white border border-gray-100 rounded-3xl p-5 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl border-2 border-gray-100 shadow-inner group-hover:scale-110 transition-transform duration-300"
                                style="background-color: {{ $color->hex_code }};">
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-gray-800">{{ $color->nama_warna }}</h3>
                                <p class="text-xs font-mono text-gray-400 tracking-wider lowercase">{{ $color->hex_code }}</p>
                            </div>
                        </div>
                        
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                            {{ $color->product_variants_count }} Varian
                        </span>
                    </div>

                    <div class="flex items-center gap-2 mt-2 pt-4 border-t border-gray-50">
                        <a href="{{ route('admin.colors.edit', $color) }}" wire:navigate
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 text-[11px] font-bold text-indigo-600 bg-indigo-50/50 rounded-xl hover:bg-indigo-600 hover:text-white transition-all uppercase tracking-wider">
                            <x-lucide-square-pen class="w-3.5 h-3.5" />
                            <span>Edit</span>
                        </a>
                        
                        <livewire:admin.color.delete :color="$color->id" :key="'color-delete-' . $color->id" />
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 bg-white border border-dashed border-gray-200 rounded-3xl flex flex-col items-center justify-center text-gray-400">
                    <x-lucide-palette class="w-12 h-12 mb-3 opacity-20" />
                    <p class="text-sm italic tracking-wide">Tidak ada warna yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8 px-2">
            {{ $colors->links() }}
        </div>
    </div>
</div>