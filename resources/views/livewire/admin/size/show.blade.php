<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.sizes.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>

    <div class="mx-auto">

        <x-ui.card-item class="overflow-hidden" rounded="rounded-[2.5rem]" shadow="shadow-xl shadow-slate-200/50"
            border="border border-slate-100">

            <x-slot:header class="px-10 py-10 ">
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div
                            class="w-16 h-16 bg-black rounded-2xl flex items-center justify-center shadow-lg  rotate-3 transition-transform hover:rotate-0">
                            <x-lucide-eye class="w-8 h-8 text-white" />
                        </div>
                        <div>
                            <h1 class="text-3xl font-black tracking-tight uppercase italic">Detail Grup Ukuran</h1>
                            <p class="font-bold mt-1 tracking-wider uppercase text-xs">
                                {{ $sizeGroup->nama_group }}
                            </p>
                        </div>
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <div class="flex flex-col gap-12">
                        <!-- Section 1: Informasi Grup -->
                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-black text-white flex items-center justify-center font-black text-sm">01</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Informasi Grup</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="group">
                                    <x-ui.form.label label="Nama Grup Ukuran" />
                                    <x-ui.form.input value="{{ $sizeGroup->nama_group }}" readonly />
                                </div>
                                <div class="group">
                                    <x-ui.form.label label="Total Nilai Ukuran" />
                                    <div
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 font-bold shadow-inner">
                                        {{ $sizeGroup->values->count() }} Size(s)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Nilai Ukuran -->
                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-black text-white flex items-center justify-center font-black text-sm">02</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Nilai Ukuran</h2>
                            </div>

                            @if ($sizeGroup->values->count() > 0)
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                    @foreach ($sizeGroup->values as $value)
                                        <div
                                            class="bg-white border-2 border-slate-100 rounded-2xl p-4 text-center shadow-sm hover:shadow-md hover:border-black/10 transition-all flex flex-col items-center justify-center gap-2 group">
                                            <span
                                                class="text-2xl font-black text-slate-800 group-hover:scale-110 transition-transform">{{ $value->label_size }}</span>
                                            <span
                                                class="text-[10px] uppercase font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg">Urutan:
                                                {{ $value->sort_order }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <x-ui.empty-state icon="ruler" title="Size Kosong" message="Belum ada nilai ukuran."
                                    class="py-8 bg-slate-50 border border-dashed border-slate-200 rounded-2xl" />
                            @endif
                        </div>

                        <!-- Section 3: Digunakan Oleh -->
                        @if ($sizeGroup->categories->count() > 0)
                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-black text-white flex items-center justify-center font-black text-sm">03</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Digunakan Oleh Kategori</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($sizeGroup->categories as $category)
                                        <div
                                            class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm hover:shadow-md hover:border-blue-200 transition-all flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                                @if ($category->image)
                                                    <img src="{{ asset('storage/' . $category->image) }}"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <x-lucide-image class="w-6 h-6 text-slate-300" />
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-800 text-sm line-clamp-1">
                                                    {{ $category->nama_category }}
                                                </h4>
                                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                                    {{ $category->products_count ?? 0 }} Produk
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </x-slot>

        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.sizes.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>
</div>