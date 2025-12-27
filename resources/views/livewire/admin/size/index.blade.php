<div class="bg-gray-50 min-h-screen p-4 md:p-8">

    @if (session('success'))
        <div class="fixed bottom-4 md:bottom-10 right-4 md:right-10 p-4 md:p-6 w-fit bg-green-400/90 rounded-lg border border-green-400 mb-2 z-50">
            {{ session('success') }}
        </div>
    @endif

    <div class="mx-auto">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 md:mb-8 gap-4">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Manajemen Grup Ukuran</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola grup ukuran dan nilainya untuk kategori produk.</p>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
                <div class="relative w-full sm:w-44">
                    <select wire:model.live="sortBy"
                        class="w-full pl-3 pr-8 py-2.5 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white text-indigo-700 shadow-sm font-semibold">
                        <option value="latest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                    </select>
                </div>

                <div class="relative flex-1 md:w-64">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-indigo-500">
                        <x-lucide-search class="w-5 h-5" />
                    </span>
                    <input type="text" wire:model.live.debounce="search" placeholder="Cari grup ukuran..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white text-indigo-700 shadow-sm">
                </div>

                <a href="{{ route('admin.sizes.create') }}" wire:navigate
                    class="flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 md:px-5 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-sm">
                    <x-lucide-plus class="w-4 h-4 md:w-5 md:h-5" />
                    <span class="hidden sm:inline">Tambah Grup Ukuran</span>
                    <span class="sm:hidden">Tambah</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @forelse ($sizeGroups as $sizeGroup)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-200">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 font-bold">
                                {{ strtoupper(substr($sizeGroup->nama_group, 0, 2)) }}
                            </div>
                            <div>
                                <a href="{{ route('admin.sizes.show', $sizeGroup->id) }}" wire:navigate
                                    class="text-lg font-bold text-gray-800 hover:text-indigo-600 transition-colors">
                                    {{ $sizeGroup->nama_group }}
                                </a>
                                <p class="text-sm text-gray-500">
                                    {{ $sizeGroup->values_count }} size value(s)
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.sizes.edit', $sizeGroup->id) }}" wire:navigate
                                class="inline-flex items-center justify-center p-2 text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition-all">
                                <x-lucide-square-pen class="w-4 h-4" />
                            </a>
                            <livewire:admin.size.delete :sizeGroup="$sizeGroup->id" :key="'size-delete-' . $sizeGroup->id" />
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Nilai Ukuran</h4>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse ($sizeGroup->values->take(6) as $value)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                        {{ $value->label_size }}
                                    </span>
                                @empty
                                    <span class="text-xs text-gray-400 italic">No values</span>
                                @endforelse
                                @if ($sizeGroup->values_count > 6)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-600">
                                        +{{ $sizeGroup->values_count - 6 }} more
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                            <span class="text-sm font-bold text-gray-400 uppercase tracking-wider">Kategori</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                {{ $sizeGroup->categories_count }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="text-gray-400 text-sm italic">
                        Belum ada grup ukuran.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            <div class="px-6 py-4">
                {{ $sizeGroups->links() }}
            </div>
        </div>
    </div>
</div>
