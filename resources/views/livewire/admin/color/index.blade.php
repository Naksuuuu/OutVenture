<div class="mx-auto">


    <x-ui.page-header title="Warna" subtitle="Lihat dan kelola semua warna yang tersedia"
        class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>

            <x-ui.search-input model="search" placeholder="Cari warna..." width="" />

            <x-ui.button-href href="{{ route('admin.colors.create') }}" label="Tambah" />
        </x-slot:actions>
    </x-ui.page-header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($colors as $color)
            <div
                class="bg-white border border-gray-100 rounded-3xl p-5 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl border-2 border-gray-100 shadow-inner group-hover:scale-110 transition-transform duration-300"
                            style="background-color: {{ $color->hex_code }};">
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-800">{{ $color->nama_warna }}</h3>
                            <p class="text-xs font-mono text-gray-400 tracking-wider lowercase">
                                {{ $color->hex_code }}</p>
                        </div>
                    </div>

                    <span
                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
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
            <div
                class="col-span-full py-20 bg-white border border-dashed border-gray-200 rounded-3xl flex flex-col items-center justify-center text-gray-400">
                <x-lucide-palette class="w-12 h-12 mb-3 opacity-20" />
                <p class="text-sm italic tracking-wide">Tidak ada warna yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8 px-2">
        {{ $colors->links() }}
    </div>
</div>
