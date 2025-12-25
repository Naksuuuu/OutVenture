<div x-data="{ openDelete: false }">
    <button type="button" @click="openDelete = true"
        class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-red-600 bg-white border border-red-200 rounded-md hover:bg-red-50 transition-all uppercase tracking-wider">
        <x-lucide-trash class="w-4 h-4" />
    </button>

    <div x-show="openDelete" x-cloak x-transition:enter="transition ease-out duration-50"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="openDelete = false">
        </div>
        <div class="relative w-full max-w-sm bg-white rounded-2xl shadow-2xl border border-slate-100 p-6 space-y-4">
            <div class="flex items-start space-x-3">
                <div
                    class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-black text-lg">
                    !
                </div>
                <div>
                    <h4 class="text-lg font-bold text-slate-800">
                        Delete Size Group?
                    </h4>
                    <p class="text-sm text-slate-500">
                        This will also delete all size values in this group. This action cannot be undone.
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" @click="openDelete = false"
                    class="text-xs font-bold text-slate-500 uppercase tracking-widest">Cancel</button>
                <form wire:submit.prevent="delete">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-white bg-red-600 border border-red-600 rounded-xl hover:bg-red-700 hover:border-red-700 transition-all duration-200 uppercase tracking-widest shadow-sm">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
