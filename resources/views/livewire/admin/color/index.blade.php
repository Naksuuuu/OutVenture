<div class="bg-gray-50 min-h-screen p-8">

    @if ($successMessage)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed bottom-10 right-10 p-6 w-fit bg-green-400/90 rounded-lg border border-green-400 mb-2 z-50 shadow-lg">
            {{ $successMessage }}
        </div>
    @endif

    @if ($errorMessage)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="fixed bottom-10 right-10 p-6 w-fit bg-red-400/90 text-white rounded-lg border border-red-400 mb-2 z-50 shadow-lg">
            {{ $errorMessage }}
        </div>
    @endif

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('close-message', () => {
                setTimeout(() => {
                    @this.set('successMessage', '');
                    @this.set('errorMessage', '');
                }, 3000);
            });
        });
    </script>

    <div class="mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Warna</h1>
                <p class="text-sm text-gray-500 mt-1">Total {{ $totalColors }} warna di database.</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-indigo-500">
                        <x-lucide-search class="w-5 h-5" />
                    </span>
                    <input type="text" wire:model.live.debounce="search" placeholder="Cari warna..."
                        class="w-64 pl-10 pr-4 py-2.5 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white text-indigo-700 shadow-sm">
                </div>

                <a href="{{ route('admin.colors.create') }}" wire:navigate
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-sm">
                    <x-lucide-plus class="w-5 h-5" />
                    Tambah Warna
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left table-fixed border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="w-[70%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama
                            Warna</th>
                        <th
                            class="w-[20%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">
                            Produk</th>
                        <th
                            class="w-[20%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($colors as $color)
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full border-2 border-gray-200 shadow-sm"
                                        style="background-color: {{ $color->hex_code }};"
                                        title="{{ $color->nama_warna }}">
                                    </div>
                                    <div>
                                        <span class="text-sm font-bold text-gray-800">{{ $color->nama_warna }}</span>
                                        <span class="block text-xs text-gray-500">{{ $color->hex_code }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-blue-100">
                                    {{ $color->product_variants_count }} varian
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.colors.edit', $color) }}" wire:navigate
                                        class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-indigo-600 bg-white border border-indigo-200 rounded-md hover:bg-indigo-50 transition-all uppercase tracking-wider">
                                        <x-lucide-square-pen class="w-4 h-4" />
                                    </a>
                                    <button wire:click="deleteColor({{ $color->id }})"
                                        wire:confirm="Hapus warna '{{ $color->nama_warna }}'?"
                                        class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-red-600 bg-white border border-red-200 rounded-md hover:bg-red-50 transition-all uppercase tracking-wider">
                                        <x-lucide-trash class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm italic">
                                Tidak ada warna tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $colors->links() }}
            </div>
        </div>
    </div>
</div>
