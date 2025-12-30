<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.brands.index') }}" wire:navigate label="Kembali ke Daftar"
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
                            <h1 class="text-3xl font-black tracking-tight uppercase italic">Detail Brand</h1>
                            <p class="font-bold mt-1 tracking-wider uppercase text-xs">
                                {{ $brand->nama_brand }}
                            </p>
                        </div>
                    </div>

                    <div>
                        @if ($brand->is_trusted)
                            <span
                                class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl font-black text-[10px] uppercase tracking-widest border border-emerald-100 shadow-sm">
                                <x-lucide-badge-check class="w-4 h-4" />
                                Trusted
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-2 bg-slate-50 text-slate-500 px-4 py-2 rounded-xl font-black text-[10px] uppercase tracking-widest border border-slate-100 shadow-sm">
                                <x-lucide-circle class="w-4 h-4" />
                                Regular
                            </span>
                        @endif
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
                                <h2 class="font-extrabold uppercase tracking-wide">Data Brand</h2>
                            </div>

                            <div class="group">
                                <x-ui.form.label label="Nama Brand" />
                                <x-ui.form.input value="{{ $brand->nama_brand }}" readonly />
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="size-10 rounded-full bg-black text-white flex items-center justify-center font-black text-sm">02</span>
                                <h2 class="font-extrabold uppercase tracking-wide">Visual Brand</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Logo -->
                                <div>
                                    <x-ui.form.label label="Official Logo" />
                                    <div
                                        class="aspect-square bg-slate-50 rounded-[2rem] border border-slate-100 flex items-center justify-center p-8 shadow-sm group hover:bg-white transition-all duration-500">
                                        @if ($brand->logo)
                                            <img src="{{ asset('storage/' . $brand->logo) }}"
                                                class="max-w-full max-h-full object-contain filter drop-shadow-md group-hover:scale-110 transition-transform duration-500"
                                                alt="Logo {{ $brand->nama_brand }}">
                                        @else
                                            <div class="text-center">
                                                <x-lucide-image class="w-12 h-12 text-slate-200 mx-auto mb-2" />
                                                <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">
                                                    No Logo</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Thumbnail -->
                                <div>
                                    <x-ui.form.label label="Thumbnail" />
                                    <div
                                        class="aspect-square bg-slate-50 rounded-[2rem] border border-slate-100 overflow-hidden shadow-sm group">
                                        @if ($brand->image)
                                            <img src="{{ asset('storage/' . $brand->image) }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                                alt="Thumbnail {{ $brand->nama_brand }}">
                                        @else
                                            <div class="flex items-center justify-center h-full">
                                                <x-lucide-image-off class="w-12 h-12 text-slate-200" />
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Wide Banner -->
                                <div class="md:col-span-2">
                                    <x-ui.form.label label="Banner" />
                                    <div
                                        class="relative aspect-[19/6] bg-slate-50 rounded-[2rem] border border-slate-100 overflow-hidden shadow-sm group">
                                        @if ($brand->wide_image)
                                            <img src="{{ asset('storage/' . $brand->wide_image) }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                                alt="Wide Banner {{ $brand->nama_brand }}">
                                        @else
                                            <div class="flex flex-col items-center justify-center h-full">
                                                <x-lucide-layout-panel-top class="w-12 h-12 text-slate-200 mb-2" />
                                                <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">
                                                    No Banner</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>

        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.brands.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>
</div>