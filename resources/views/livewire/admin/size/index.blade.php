<div class="bg-gray-50 min-h-screen p-8">

    @if (session('success'))
        <div class="fixed bottom-10 right-10 p-6 w-fit bg-green-400/90 rounded-lg border border-green-400 mb-2 z-50">
            {{ session('success') }}
        </div>
    @endif

    <div class="mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Manajemen Grup Ukuran</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola grup ukuran dan nilainya untuk kategori produk.</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-indigo-500">
                        <x-lucide-search class="w-5 h-5" />
                    </span>
                    <input type="text" wire:model.live.debounce="search" placeholder="Cari grup ukuran..."
                        class="w-64 pl-10 pr-4 py-2.5 border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white text-indigo-700 shadow-sm">
                </div>

                <a href="{{ route('admin.sizes.create') }}" wire:navigate
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-sm">
                    <x-lucide-plus class="w-5 h-5" />
                    Tambah Grup Ukuran
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left table-fixed border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="w-[30%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            Nama Grup Ukuran
                        </th>
                        <th class="w-[40%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            Nilai Ukuran
                        </th>
                        <th
                            class="w-[15%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">
                            Kategori
                        </th>
                        <th
                            class="w-[15%] px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($sizeGroups as $sizeGroup)
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 font-bold">
                                        {{ strtoupper(substr($sizeGroup->nama_group, 0, 2)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.sizes.show', $sizeGroup->id) }}" wire:navigate
                                            class="text-sm font-bold text-gray-800 hover:text-indigo-600 transition-colors">
                                            {{ $sizeGroup->nama_group }}
                                        </a>
                                        <p class="text-xs text-gray-500">
                                            {{ $sizeGroup->values_count }} size value(s)
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse ($sizeGroup->values->take(8) as $value)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                            {{ $value->label_size }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400 italic">No values</span>
                                    @endforelse
                                    @if ($sizeGroup->values_count > 8)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-indigo-50 text-indigo-600">
                                            +{{ $sizeGroup->values_count - 8 }} more
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    {{ $sizeGroup->categories_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.sizes.edit', $sizeGroup->id) }}" wire:navigate
                                        class="inline-flex items-center justify-center px-4 py-1.5 text-[11px] font-bold text-indigo-600 bg-white border border-indigo-200 rounded-md hover:bg-indigo-50 transition-all uppercase tracking-wider">
                                        <x-lucide-square-pen class="w-4 h-4" />
                                    </a>
                                    <livewire:admin.size.delete :sizeGroup="$sizeGroup->id" :key="'size-delete-' . $sizeGroup->id" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm italic">
                                Belum ada grup ukuran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $sizeGroups->links() }}
            </div>
        </div>
    </div>
</div>
