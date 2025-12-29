@props(['title' => 'Hapus data?', 'message' => 'Yakin ingin menghapus data ini?', 'errorMessage' => null])

<div x-data="{
    openDelete: false,
    itemId: null,
    openModal(id) {
        if (this.itemId !== id) {
            $wire.set('errorMessage', '');
        }
        this.itemId = id;
        this.openDelete = true;

    }
}" @open-delete-modal.window="openModal($event.detail.id)"
    @delete-success.window="openDelete = false">



    <template x-teleport="body">
        <div x-show="openDelete" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center p-4">
            <div x-show="openDelete" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm"
                @click="openDelete = false">
            </div>


            <div x-show="openDelete" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative z-[10000] w-full max-w-sm bg-white rounded-2xl shadow-2xl border border-slate-100 p-6 space-y-4">
                <div class="flex items-start space-x-3">
                    <div
                        class="w-10 h-10 rounded-full text-red-600 flex items-center justify-center font-black text-lg">
                        <x-lucide-circle-alert />
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800">{{ $title }}</h4>
                        <p class="text-sm text-slate-500">{{ $message }}</p>
                    </div>
                </div>

                @if ($errorMessage)
                    <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                        <p class="text-sm text-red-700 font-medium">{{ $errorMessage }}</p>
                    </div>
                @endif

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" @click="openDelete = false"
                        class="text-xs font-bold text-slate-500 uppercase tracking-widest hover:text-slate-700 transition-colors">
                        Batal
                    </button>

                    @if (!$errorMessage)
                        <button type="button" wire:click="delete(itemId)"
                            class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-white bg-red-600 border border-red-600 rounded-xl hover:bg-red-700 hover:border-red-700 transition-all duration-200 uppercase tracking-widest shadow-sm"
                            wire:loading.attr="disabled" wire:loading.class="opacity-70 cursor-not-allowed">

                            <span wire:loading.remove wire:target="delete">Hapus</span>
                            <span wire:loading wire:target="delete">
                                <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
