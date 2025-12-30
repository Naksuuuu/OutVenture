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
                        class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center shadow-lg  rotate-3 transition-transform hover:rotate-0">
                        <x-lucide-plus class="w-8 h-8 text-blue-600" />
                    </div>
                    <div>
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Tambah Brand</h1>
                        <p class="text-blue-400 font-bold mt-1 tracking-wider uppercase text-xs">
                            Brand Baru
                        </p>
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <form wire:submit.prevent="save" class="space-y-10">
                        <div class="flex flex-col gap-12">
                            <!-- Section 1: Data Brand -->
                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-black text-sm">01</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Informasi Dasar</h2>
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Nama Brand" />
                                    <x-ui.form.input wire:model="nama_brand" type="text"
                                        placeholder="Masukkan nama brand..." />
                                </div>

                                <div class="pt-2">
                                    <label
                                        class="relative flex items-center p-5 bg-slate-50 rounded-3xl cursor-pointer hover:bg-slate-100 transition-all border border-transparent hover:border-blue-100 group">
                                        <input wire:model="is_trusted" type="checkbox"
                                            class="w-6 h-6 text-blue-600 bg-white border-slate-200 rounded-lg focus:ring-offset-0 focus:ring-transparent transition-all">
                                        <div class="ml-4">
                                            <span
                                                class="block text-sm font-black text-slate-700 uppercase tracking-tight">Set
                                                sebagai Trusted Brand</span>
                                            <span class="text-xs text-slate-400 font-medium italic">Berikan lencana
                                                verifikasi pada brand ini.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Section 2: Visual Brand -->
                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-black text-sm">02</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Visual Brand</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <!-- Logo (1:1) -->
                                    <div class="space-y-4">
                                        <x-ui.form.image-upload wire:model="logo" :image="$logo"
                                            label="Upload Logo (1:1)" />
                                    </div>

                                    <!-- Thumbnail -->
                                    <div class="space-y-4">
                                        <x-ui.form.image-upload wire:model="image" :image="$image"
                                            label="Upload Thumbnail" />
                                    </div>

                                    <!-- Wide Banner -->
                                    <div class="md:col-span-2 space-y-4">
                                        <x-ui.form.image-upload wire:model="wide_image" :image="$wide_image"
                                            label="Upload Banner Utama (Wide Hero)" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-ui.button type="submit" variant="create-ghost" icon="check" label="Simpan Brand" />
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