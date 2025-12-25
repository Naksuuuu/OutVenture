<div class="py-12 px-4 sm:px-6">
    <div class="mx-auto">

        <div
            class="bg-white rounded-3xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden">

            <div
                class="glass-header px-8 py-8 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-black rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                            Buat Grup Ukuran</h1>
                        <p class="text-sm text-slate-500 mt-1">Tambahkan grup ukuran baru dengan beberapa nilai ukuran
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-10">

                <form wire:submit.prevent="save">
                    <section>
                        <div class="flex items-center space-x-2 mb-6">
                            <span class="text-indigo-600 font-bold text-lg">01</span>
                            <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                                Size Group Information
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 gap-8">
                            <div>
                                <label class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                    Group Name
                                </label>
                                <input wire:model="nama_group" type="text"
                                    placeholder="e.g., Apparel, Shoes, General"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium">
                                @error('nama_group')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <section class="mt-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-2">
                                <span class="text-indigo-600 font-bold text-lg">02</span>
                                <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                                    Size Values
                                </h2>
                            </div>
                            <button type="button" wire:click="addSizeValue"
                                class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl font-semibold text-xs transition-all shadow-sm">
                                <x-lucide-plus class="w-4 h-4" />
                                Add Value
                            </button>
                        </div>

                        <div class="space-y-4">
                            @foreach ($sizeValues as $index => $sizeValue)
                                <div class="flex items-start gap-4 bg-slate-50 p-4 rounded-2xl">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 font-bold text-sm">
                                        {{ $index + 1 }}
                                    </div>

                                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-[11px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                                Size Label
                                            </label>
                                            <input wire:model="sizeValues.{{ $index }}.label_size" type="text"
                                                placeholder="e.g., S, M, L, XL, 38, 39, 40"
                                                class="w-full bg-white border-none rounded-xl px-4 py-3 text-slate-800 shadow-sm focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 placeholder:text-slate-400 font-medium text-sm">
                                            @error('sizeValues.' . $index . '.label_size')
                                                <span
                                                    class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label
                                                class="block text-[11px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                                Sort Order
                                            </label>
                                            <input wire:model="sizeValues.{{ $index }}.sort_order" type="number"
                                                class="w-full bg-white border-none rounded-xl px-4 py-3 text-slate-800 shadow-sm focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 font-medium text-sm">
                                        </div>
                                    </div>

                                    @if (count($sizeValues) > 1)
                                        <button type="button" wire:click="removeSizeValue({{ $index }})"
                                            class="flex-shrink-0 p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                            <x-lucide-trash class="w-5 h-5" />
                                        </button>
                                    @endif
                                </div>
                            @endforeach

                            @if (empty($sizeValues))
                                <div class="text-center py-8 text-slate-400">
                                    <p class="text-sm italic">Belum ada nilai ukuran. Klik "Tambah Nilai" untuk memulai.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </section>

                    <div class="flex items-center justify-end px-8 py-6 mt-8">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-xl shadow-indigo-200 transition-all active:scale-95">
                            Simpan Grup Ukuran
                        </button>
                    </div>
                </form>

            </div>

            <div class="bg-slate-50/80 px-8 py-6 flex items-center border-t border-slate-100">
                <a href="{{ route('admin.sizes.index') }}" wire:navigate
                    class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
            &copy; 2025 Praktikum Web &bull; Management System
        </p>
    </div>
</div>
