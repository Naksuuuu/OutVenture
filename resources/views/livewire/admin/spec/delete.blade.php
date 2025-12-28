<div x-data="{ openDelete: false }" @spec-events.window="openDelete = false">
    <button type="button" @click="openDelete = true"
        class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-red-500 bg-white border border-red-100 rounded-xl hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-300 uppercase tracking-widest shadow-sm">
        <x-lucide-trash-2 class="w-3 h-3 mr-1.5" />
        Hapus
    </button>

    <div x-show="openDelete" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
        style="position: fixed; left: 0; right: 0; top: 0; bottom: 0;">
        <div class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm" @click="openDelete = false"
            style="position: fixed; left: 0; right: 0; top: 0; bottom: 0;">
        </div>
        <div class="relative w-full max-w-sm bg-white rounded-2xl shadow-2xl border border-slate-100 p-6 space-y-6"
            style="position: relative; z-index: 10000;">

            <div class="flex items-start space-x-4">
                <div
                    class="flex-shrink-0 w-11 h-11 rounded-full text-red-600 flex items-center justify-center font-bold text-xl">
                    <x-lucide-circle-alert />
                </div>
                <div class="flex-1 text-left">
                    <h4 class="text-xl font-bold text-slate-800">
                        Hapus spesifikasi?
                    </h4>
                    <p class="mt-1 text-sm text-slate-500">
                        Yakin ingin menghapus spesifikasi ini? Data tidak bisa dikembalikan.
                    </p>
                </div>
            </div>

            @if ($errorMessage)
                <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                    <p class="text-sm text-red-700 font-medium">{{ $errorMessage }}</p>
                </div>
            @endif

            <div class="flex items-center justify-end gap-3">
                <button type="button" @click="openDelete = false"
                    class="px-4 py-2 text-xs font-bold text-slate-500 uppercase tracking-widest hover:text-slate-700 transition-colors">
                    Batal
                </button>
                @if (!$errorMessage)
                    <button type="button" wire:click="delete"
                        class="inline-flex items-center justify-center px-6 py-2.5 text-[11px] font-black text-white bg-red-600 border border-red-600 rounded-xl hover:bg-red-700 transition-all duration-200 uppercase tracking-widest shadow-md">
                        <span wire:loading.remove>Hapus</span>
                        <span wire:loading wire:target="delete">
                            <x-lucide-loader-2 class="w-4 h-4 animate-spin" />
                        </span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
