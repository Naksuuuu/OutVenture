@props([
    'title' => 'Hapus data?',
    'message' => 'Yakin ingin menghapus data ini?',
    'errorMessage' => null,
    'action' => 'delete',
    'trigger' => 'open-delete-modal',
])

<div x-data="{
    openDelete: false,
    itemId: null,
    openModal(id) {
        if (this.itemId !== id) {
            $wire.set('errorMessage', '');
        }
        this.itemId = id;
        this.openDelete = true;
    },
}" x-on:{{ $trigger }}.window="openModal($event.detail.id)"
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
                        <x-ui.button type="button" wire:click="{{ $action }}(itemId)" label="Hapus"
                            variant="delete" icon="trash" :loading-target="$action" />
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
