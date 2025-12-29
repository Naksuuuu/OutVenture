<div class="">



    <x-ui.page-header title="Manajemen Grup Ukuran" subtitle="Kelola grup ukuran dan nilainya untuk kategori produk."
        class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>
            <livewire:ui.dropdown wire:model.live="sortBy" :options="['latest' => 'Terbaru', 'oldest' => 'Terlama']" class="" />


            <x-ui.search-input model="search" placeholder="Cari grup ukuran..." width="" />


            <x-ui.button-href href="{{ route('admin.sizes.create') }}" label="Tambah" />
        </x-slot:actions>
    </x-ui.page-header>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @forelse ($sizeGroups as $sizeGroup)
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 font-bold">
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
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                    {{ $value->label_size }}
                                </span>
                            @empty
                                <span class="text-xs text-gray-400 italic">No values</span>
                            @endforelse
                            @if ($sizeGroup->values_count > 6)
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-600">
                                    +{{ $sizeGroup->values_count - 6 }} more
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                        <span class="text-sm font-bold text-gray-400 uppercase tracking-wider">Kategori</span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-md text-sm font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
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
