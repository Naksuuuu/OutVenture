<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.categories.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>

    <div class="mx-auto">

        <x-ui.card-item class="overflow-hidden" rounded="rounded-[2.5rem]" shadow="shadow-xl shadow-slate-200/50"
            border="border border-slate-100">

            <x-slot:header class="px-10 py-10 ">
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div
                            class="w-16 h-16 bg-black  rounded-2xl flex items-center justify-center shadow-lg  rotate-3 transition-transform hover:rotate-0">
                            <x-lucide-eye class="w-8 h-8 text-white" />
                        </div>
                        <div>
                            <h1 class="text-3xl font-black tracking-tight uppercase italic">Detail Kategori</h1>
                            <p class="font-bold mt-1 tracking-wider uppercase text-xs">
                                {{ $category->nama_category }}
                            </p>
                        </div>
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <div class="flex flex-col gap-12">
                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-black text-white flex items-center justify-center font-black text-sm">01</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Data
                                    Kategori
                                </h2>
                            </div>

                            <div class="group">
                                <x-ui.form.label label="Nama Kategori" />
                                <x-ui.form.input value="{{ $category->nama_category }}" readonly />
                            </div>

                            <div class="group">
                                <x-ui.form.label label="Format Ukuran" />
                                <x-ui.form.input value="{{ $category->sizeGroup->nama_group }}" readonly />
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-black text-white flex items-center justify-center font-black text-sm">02</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Preview
                                    Visual
                                </h2>
                            </div>

                            <div class="relative group">
                                <div
                                    class="aspect-square w-full max-w-[350px] mx-auto rounded-[3.5rem] overflow-hidden bg-slate-100 border-8 border-white shadow-2xl relative z-10 transition-all duration-500 group-hover:scale-[1.02] group-hover:-rotate-1 flex items-center justify-center">
                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                            class="w-full h-full object-cover" alt="{{ $category->nama_category }}">
                                    @else
                                        <div
                                            class="flex flex-col items-center justify-center text-slate-300 p-10 text-center">
                                            <x-ui.image-placeholder size="lg" icon="image" class="opacity-30 mb-4" />
                                            <p
                                                class="text-[10px] font-black uppercase tracking-widest opacity-40 leading-relaxed">
                                                Gambar Tidak<br>Tersedia</p>
                                        </div>
                                    @endif
                                </div>

                                <div
                                    class="absolute -bottom-6 -right-6 w-full h-full max-w-[350px] mx-auto bg-emerald-500/10 rounded-[3.5rem] -rotate-6 z-0 transition-transform group-hover:rotate-0 group-hover:scale-105 duration-500 left-0 right-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>

        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.categories.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>
</div>