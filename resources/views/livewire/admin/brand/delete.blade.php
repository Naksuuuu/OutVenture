    <div x-data="{ openDelete: false }">
        <button type="button" @click="openDelete = true"
            class="p-2 text-gray-400 hover:text-red-600 hover:bg-indigo-50 rounded-lg transition-colors">
            <x-lucide-trash />
        </button>

        <template x-teleport="body">
            <div x-show="openDelete" x-cloak class="flex"
                style="position: fixed !important; height: 100%; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; z-index: 999999 !important;  padding: 1rem; background-color: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); margin: 0 !important; transform: none !important;"
                @click="openDelete = false">

                <div @click.stop
                    style="position: relative; width: 100%;  max-width: 24rem; background: white; border-radius: 1rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); border: 1px solid #f1f5f9; padding: 1.5rem; z-index: 1000000; margin: auto;">
                    <div class="flex items-start space-x-3">
                        <div
                            class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-black text-lg">
                            !</div>
                        <div>
                            <h4 class="text-lg font-bold text-slate-800">Hapus brand?</h4>
                            <p class="text-sm text-slate-500">Yakin ingin menghapus brand ini?</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" @click="openDelete = false"
                            class="text-xs font-bold text-slate-500 uppercase tracking-widest">Batal</button>
                        <button type="button" wire:click="delete"
                            class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-white bg-red-600 border border-red-600 rounded-xl hover:bg-red-700 hover:border-red-700 transition-all duration-200 uppercase tracking-widest shadow-sm"
                            wire:loading.attr="disabled" wire:loading.class="opacity-70 cursor-not-allowed">
                            <span wire:loading.remove>Hapus</span>
                            <span wire:loading wire:target="delete">
                                <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div wire:loading wire:target="delete"
                        class="mt-2 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-xs text-blue-700 font-semibold">Sedang menghapus...</p>
                    </div>
                </div>
            </div>
        </template>


    </div>
