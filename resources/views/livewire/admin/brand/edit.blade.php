<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.brands.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>

    <div class="mx-auto">

        <x-ui.card-item class="overflow-hidden" rounded="rounded-[2.5rem]" shadow="shadow-xl shadow-slate-200/50"
            border="border border-slate-100">

            <x-slot:header class="px-10 py-10 ">
                <div class="relative z-10 flex items-center gap-6">
                    <div
                        class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center shadow-lg  rotate-3 transition-transform hover:rotate-0">
                        <x-lucide-square-pen class="w-8 h-8 text-emerald-600" />
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Edit Brand</h1>
                        <p class="text-emerald-400 font-bold mt-1 tracking-wider uppercase text-xs">
                            {{ $brand->nama_brand }}
                        </p>
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <form wire:submit.prevent="update" class="space-y-10">
                        <div class="flex flex-col gap-12">
                            <!-- Section 1: Data Brand -->
                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">01</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Data Brand</h2>
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Nama Brand" />
                                    <x-ui.form.input wire:model="nama_brand" type="text" />
                                </div>

                                <div class="pt-2">
                                    <label
                                        class="relative flex items-center p-5 bg-slate-50 rounded-3xl cursor-pointer hover:bg-slate-100 transition-all border border-transparent hover:border-emerald-100 group">
                                        <input wire:model="is_trusted" type="checkbox"
                                            class="w-6 h-6 text-emerald-600 bg-white border-slate-200 rounded-lg focus:ring-offset-0 focus:ring-transparent transition-all">
                                        <div class="ml-4    ">
                                            <span
                                                class="block text-sm font-black text-slate-700 uppercase tracking-tight">Set
                                                sebagai Trusted Brand</span>
                                            <span class="text-xs text-slate-400 font-medium italic">Status verifikasi
                                                brand saat ini.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Section 2: Visual Brand -->
                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">02</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Visual Brand</h2>
                                </div>

                                <!-- Logo -->
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <x-ui.form.label label="Official Logo" />
                                            <div
                                                class="aspect-square rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner flex items-center justify-center group relative p-6">
                                                @if ($brand->logo)
                                                    <img src="{{ asset('storage/' . $brand->logo) }}"
                                                        class="max-w-full max-h-full object-contain opacity-80">
                                                @else
                                                    <x-ui.image-placeholder icon="image" size="sm" class="opacity-50" />
                                                @endif
                                                <div class="absolute inset-0 flex items-end justify-center pb-2">
                                                    <span class="text-[10px] font-bold text-slate-300 uppercase">Logo
                                                        Saat Ini</span>
                                                </div>
                                            </div>
                                        </div>
                                        <x-ui.form.image-upload wire:model="new_logo" :image="$new_logo"
                                            label="Upload Logo Baru" />
                                    </div>
                                </div>

                                <!-- Thumbnail -->
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <x-ui.form.label label="Thumbnail Image" />
                                            <div
                                                class="aspect-square rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner flex items-center justify-center group relative">
                                                @if ($brand->image)
                                                    <img src="{{ asset('storage/' . $brand->image) }}"
                                                        class="w-full h-full object-cover opacity-80">
                                                @else
                                                    <x-ui.image-placeholder icon="image" size="sm" class="opacity-50" />
                                                @endif
                                                <div class="absolute inset-0 flex items-end justify-center pb-2">
                                                    <span
                                                        class="text-[10px] font-bold text-slate-300 uppercase shadow-sm">Thumbnail
                                                        Saat Ini</span>
                                                </div>
                                            </div>
                                        </div>
                                        <x-ui.form.image-upload wire:model="new_image" :image="$new_image"
                                            label="Upload Thumbnail Baru" />
                                    </div>
                                </div>

                                <!-- Wide Banner -->
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 gap-4">
                                        <x-ui.form.label label="Wide Banner (Hero)" />

                                        <div
                                            class="aspect-19/6 w-full rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner flex items-center justify-center group relative">
                                            @if ($brand->wide_image)
                                                <img src="{{ asset('storage/' . $brand->wide_image) }}"
                                                    class="w-full h-full object-cover opacity-80">
                                            @else
                                                <x-ui.image-placeholder icon="layout-panel-top" size="md"
                                                    class="opacity-50" />
                                            @endif
                                            <div
                                                class="absolute inset-0 flex items-center justify-center bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <span
                                                    class="bg-white/80 backdrop-blur px-3 py-1 rounded-full text-[10px] font-bold text-slate-600 uppercase">Banner
                                                    Saat Ini</span>
                                            </div>
                                        </div>
                                        <x-ui.form.image-upload wire:model="new_wide_image" :image="$new_wide_image"
                                            label="Upload Banner Baru (Wide)" aspect="aspect-[19/6]" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-ui.button type="submit" variant="update-ghost" icon="check" label="Simpan Perubahan" />
                    </form>
                </div>
            </x-slot>

        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.brands.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>
</div>