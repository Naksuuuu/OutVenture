<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.categories.index') }}" wire:navigate label="Kembali ke Daftar"
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
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Tambah Kategori</h1>
                        <p class="text-blue-400 font-bold mt-1 tracking-wider uppercase text-xs">
                            Kategori Baru
                        </p>
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <form wire:submit.prevent="save" class="space-y-10">
                        <div class="flex flex-col gap-12">
                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-black text-sm">01</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Informasi
                                        Dasar
                                    </h2>
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Nama Kategori" />
                                    <x-ui.form.input wire:model="nama_category" type="text"
                                        placeholder="Contoh: Tenda Camping" />
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Kelompok Ukuran" />
                                    <x-ui.form.select wire:model="id_size_group">
                                        <option value="">Pilih Size Group</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}" @selected($id_size_group == $size->id)>
                                                {{ $size->nama_group }}
                                            </option>
                                        @endforeach
                                    </x-ui.form.select>
                                </div>
                            </div>

                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-black text-sm">02</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Visual
                                        Kategori
                                    </h2>
                                </div>

                                <x-ui.form.image-upload wire:model="image" :image="$image" label="Upload Foto"
                                    class="max-w-[450px]" />
                            </div>
                        </div>

                        <x-ui.button type="submit" variant="create-ghost" icon="check" label="Simpan Kategori" />
                    </form>
                </div>
            </x-slot>

        </x-ui.card-item>

    </div>

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.categories.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>
</div>