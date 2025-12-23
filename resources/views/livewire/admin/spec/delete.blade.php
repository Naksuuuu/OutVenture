 <div x-data="{ openDelete: false }">
     <button type="button" @click="openDelete = true"
         class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-red-500 bg-white border border-red-100 rounded-xl hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-300 uppercase tracking-widest shadow-sm">
         <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                 d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
             </path>
         </svg>
         Hapus
     </button>

     <div x-show="openDelete" x-cloak x-transition:enter="transition ease-out duration-200"
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
                         Hapus
                         spesifikasi?
                     </h4>
                     <p class="text-sm text-slate-500">
                         Yakin
                         ingin
                         menghapus
                         spesifikasi
                         ini
                     </p>
                 </div>
             </div>
             <div class="flex items-center justify-end gap-3 pt-2">
                 <button type="button" @click="openDelete = false"
                     class="text-xs font-bold text-slate-500 uppercase tracking-widest">Batal</button>
                 <form wire:submit.prevent="save">
                     @csrf
                     @method('DELETE')
                     <input type="hidden" wire:model="id">
                     <button type="submit"
                         class="inline-flex items-center justify-center px-4 py-2 text-[11px] font-black text-white bg-red-600 border border-red-600 rounded-xl hover:bg-red-700 hover:border-red-700 transition-all duration-200 uppercase tracking-widest shadow-sm">
                         Hapus
                     </button>
                 </form>
             </div>
         </div>
     </div>
 </div>
