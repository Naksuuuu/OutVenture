<div class="p-8 bg-slate-50/50 min-h-screen">
    {{-- Modal Pop-up Notifikasi Success/Error --}}
    @if (session('success') || session('error'))
        <div x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
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
                    @if (session('success'))
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
                    <h3 class="text-xl font-bold {{ session('success') ? 'text-green-600' : 'text-red-600' }} mb-2">
                        {{ session('success') ? 'Berhasil!' : 'Gagal!' }}
                    </h3>
                    <p class="text-slate-600 text-sm">
                        {{ session('success') ?: session('error') }}
                    </p>
                </div>

                <div class="flex items-center justify-center pt-4">
                    <button @click="show = false"
                        class="text-xs font-bold text-slate-500 uppercase tracking-widest hover:text-slate-700 transition-colors px-6 py-2 rounded-lg hover:bg-slate-50">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Kategori</h2>
            <p class="text-slate-500 mt-2 font-medium font-sans">Kelola struktur katalog produk Anda dengan sistem yang
                lebih rapi.</p>
        </div>

        <div class="flex items-center gap-4 w-full md:w-auto">
            <select wire:model.live="sortBy"
                class="px-4 py-3 text-sm border-none rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 focus:ring-2 focus:ring-emerald-500 transition-all outline-none font-medium text-slate-700 cursor-pointer hover:ring-slate-300">
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
            </select>

            <div class="relative flex-1 md:w-72 group">
                <span
                    class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                    <x-lucide-search class="w-5 h-5" />
                </span>
                <input type="text" wire:model.live.debounce="search" placeholder="Cari kategori..."
                    class="w-full pl-12 pr-4 py-3 text-sm border-none rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 focus:ring-2 focus:ring-emerald-500 transition-all outline-none font-medium">
            </div>

            <a href="{{ route('admin.categories.create') }}" wire:navigate
                class="flex items-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all shadow-lg active:scale-95">
                <x-lucide-plus class="w-5 h-5" />
                <span>Tambah Baru</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($categories as $category)
            <div
                class="group bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden relative">

                <div
                    class="absolute -right-6 -bottom-6 text-slate-50 group-hover:text-emerald-50/50 transition-colors duration-500">
                    <x-lucide-layers class="w-32 h-32" />
                </div>

                <div class="relative flex flex-col h-full">
                    <div class="h-48 overflow-hidden relative bg-slate-100">
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                                alt="{{ $category->nama_category }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <x-lucide-image class="w-12 h-12" />
                            </div>
                        @endif

                        <div
                            class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="p-2.5 bg-white/90 backdrop-blur text-slate-600 hover:text-emerald-600 rounded-xl shadow-xl transition-colors">
                                <x-lucide-square-pen class="w-5 h-5" />
                            </a>
                            <livewire:admin.category.delete :category="$category->id" :key="'category-delete-' . $category->id" />
                        </div>
                    </div>

                    <div class="p-6 flex-1 bg-white relative">
                        <a href="{{ route('admin.categories.show', $category->id) }}" wire:navigate
                            class="text-xl font-black text-slate-800 hover:text-emerald-600 transition-colors block mb-2 tracking-tight">
                            {{ $category->nama_category }}
                        </a>
                        <div class="flex items-center text-slate-400">
                            <div class="w-7 h-7 rounded-full bg-emerald-50 flex items-center justify-center mr-3">
                                <x-lucide-package class="w-4 h-4 text-emerald-600" />
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-500">
                                {{ $category->products_count ?? 0 }} Produk
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
