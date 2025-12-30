<div class="py-8 px-4 sm:px-6">
    <div class="flex items-center justify-between mb-12">
        <x-ui.back-link href="{{ route('admin.sizes.index') }}" wire:navigate label="Kembali ke Daftar"
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
                        <h1 class="text-3xl font-black tracking-tight uppercase italic">Edit Grup Ukuran</h1>
                        <p class="text-emerald-400 font-bold mt-1 tracking-wider uppercase text-xs">
                            {{ $sizeGroup->nama_group }}
                        </p>
                    </div>
                </div>
            </x-slot:header>

            <x-slot>
                <div class="p-8 md:p-12">
                    <form wire:submit.prevent="update" class="space-y-10">
                        <div class="flex flex-col gap-12">
                            <!-- Section 1: Informasi Dasar -->
                            <div class="space-y-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <span
                                        class="size-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">01</span>
                                    <h2 class="font-extrabold uppercase tracking-wide">Informasi Dasar</h2>
                                </div>

                                <div class="group">
                                    <x-ui.form.label label="Nama Grup Ukuran" />
                                    <x-ui.form.input wire:model="nama_group" type="text"
                                        placeholder="Contoh: Sepatu Pria, Kaos Wanita, Universal" />
                                </div>
                            </div>

                            <!-- Section 2: Nilai Ukuran -->
                            <div class="space-y-8">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="size-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-black text-sm">02</span>
                                        <h2 class="font-extrabold uppercase tracking-wide">Nilai Ukuran</h2>
                                    </div>
                                    <x-ui.button type="button" wire:click="addSizeValue" variant="create-ghost"
                                        label="Tambah Nilai" icon="plus" size="md" />
                                </div>

                                <div class="space-y-4">
                                    @foreach ($sizeValues as $index => $sizeValue)
                                        <div
                                            class="flex items-center gap-4 bg-slate-50 p-6 rounded-2xl border border-slate-100 group hover:border-emerald-100 transition-colors">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 font-black text-xs shadow-sm mt-1">
                                                {{ $index + 1 }}
                                            </div>

                                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="space-y-2">
                                                    <x-ui.form.label label="Label Ukuran" />
                                                    <x-ui.form.input wire:model="sizeValues.{{ $index }}.label_size"
                                                        placeholder="Contoh: S, M, XL, 42" class="bg-white" />
                                                </div>

                                                <div class="space-y-2">
                                                    <x-ui.form.label label="Urutan" />
                                                    <x-ui.form.input wire:model="sizeValues.{{ $index }}.sort_order"
                                                        type="number" class="bg-white" />
                                                </div>
                                            </div>

                                            @if (count($sizeValues) > 1)
                                                <div class="mt-1">
                                                    <x-ui.button type="button"
                                                        @click="$dispatch('open-delete-modal', { id: {{ $index }} })"
                                                        variant="delete" icon="trash" size="md" class="bg-white shadow-sm" />
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach

                                    @if (empty($sizeValues))
                                        <div
                                            class="text-center py-10 px-6 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200">
                                            <p class="text-slate-400 font-medium text-sm">Belum ada nilai ukuran. Klik
                                                tombol "Tambah Nilai" di atas.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-slate-100">
                            <x-ui.button type="submit" variant="edit" icon="check" label="Simpan Perubahan"
                                class="w-full md:w-auto" />
                        </div>
                    </form>
                </div>
            </x-slot>

        </x-ui.card-item>

    </div>

    <x-ui.modal.delete title="Hapus Nilai Ukuran?" message="Yakin ingin menghapus nilai ukuran ini?"
        action="deleteValue" :errorMessage="$errorMessage" />

    <div class="flex items-center justify-between mt-12">
        <x-ui.back-link href="{{ route('admin.sizes.index') }}" wire:navigate label="Kembali ke Daftar"
            class="text-slate-500 hover:text-slate-800 text-[11px] font-bold uppercase tracking-widest transition-colors flex items-center group" />
    </div>
</div>