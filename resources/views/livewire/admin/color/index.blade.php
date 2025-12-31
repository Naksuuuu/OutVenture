<div class="">

    <x-ui.page-header title="Manajemen Warna" subtitle="Kelola palet warna untuk varian produk."
        class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>

            <x-ui.search-input model="search" placeholder="Cari warna..." width="" />

            <x-ui.link href="{{ route('admin.colors.create') }}" label="Tambah" icon="plus" variant="create" />
        </x-slot:actions>
    </x-ui.page-header>

    <div class="px-6 py-4 ">
        {{ $colors->links('components.ui.pagination') }}
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
        @forelse ($colors as $color)
            <x-ui.card-item
                class="group justify-self-center flex flex-col justify-between h-[350px] w-full max-w-xl p-3 transition-all duration-300"
                rounded="rounded-2xl" hover="hover:shadow-lg hover:-translate-y-2">

                <x-slot:header
                    class="w-full h-1/2 bg-indigo-50/50 rounded-2xl overflow-hidden flex items-center justify-center border border-indigo-100/50 group-hover:bg-indigo-50 transition-colors relative">

                    <div class="absolute top-3 right-3">
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-white/80 backdrop-blur-sm text-slate-500 shadow-sm border border-slate-200">
                            {{ $color->product_variants_count }} Varian
                        </span>
                    </div>

                    <div class="flex flex-col items-center gap-3">
                        <div class="w-16 h-16 rounded-full border-4 border-white shadow-md group-hover:scale-110 transition-transform duration-300"
                            style="background-color: {{ $color->hex_code }};">
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-black uppercase tracking-widest text-indigo-300 mb-1">Kode Hex</span>
                            <span
                                class="text-sm font-bold font-mono text-slate-600 bg-white px-2 py-1 rounded-md border border-slate-200 shadow-sm">{{ $color->hex_code }}</span>
                        </div>
                    </div>
                </x-slot:header>

                <x-slot>
                    <div class="rounded-b-2xl h-1/2 pt-4 pb-2 px-2 flex flex-col justify-between">
                        <div>
                            <h4
                                class="text-xl font-extrabold text-slate-800 text-center mb-1 group-hover:text-indigo-600 transition-colors">
                                {{ $color->nama_warna }}
                            </h4>
                        </div>

                        <div class="flex items-center gap-2 mt-auto">
                            <x-ui.link href="{{ route('admin.colors.edit', $color) }}" label='Edit' icon="square-pen"
                                size="md" variant="edit" class="flex-1" />
                            <x-ui.button variant="delete" size="md" icon="trash"
                                @click="$dispatch('open-delete-modal', { id: {{ $color->id }} })" />
                        </div>
                    </div>
                </x-slot>
            </x-ui.card-item>
        @empty
            <div class="col-span-full bg-white rounded-2xl p-16 text-center border-2 border-dashed border-slate-200">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <x-lucide-palette class="w-8 h-8 text-slate-300" />
                </div>
                <p class="text-slate-800 font-bold text-lg">Belum ada warna</p>
                <p class="text-sm text-slate-400 mt-1">Tambahkan warna baru untuk varian produk</p>
                <div class="mt-6">
                    <x-ui.link href="{{ route('admin.colors.create') }}" label="Buat Warna Baru" icon="plus"
                        variant="create" />
                </div>
            </div>
        @endforelse
    </div>

    <x-ui.modal.delete title="Hapus Warna?" message="Yakin ingin menghapus warna ini?" :errorMessage="$errorMessage" />

    <div class="px-6 py-4">
        {{ $colors->links('components.ui.pagination') }}
    </div>
</div>