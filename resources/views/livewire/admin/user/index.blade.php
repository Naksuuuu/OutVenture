<div class="p-4 md:p-6 max-w-7xl mx-auto">
    <div
        class="mb-4 md:mb-9 border-b-2 border-gray-100 pb-4 md:pb-6 flex flex-wrap justify-between items-center gap-3 md:gap-5">

        <div class="flex-1 min-w-[280px]">
            <h2 class="font-extrabold uppercase m-0 tracking-wide text-gray-900 text-2xl md:text-3xl">Admin Users</h2>
            <p class="text-gray-600 mt-1 text-sm">Kelola dan atur identitas administrator Anda</p>
        </div>

        <div class="flex flex-wrap gap-2 md:gap-3 items-center w-full max-w-fit">

            <div class="relative flex-1 min-w-[120px]">
                <select wire:model.live="roleFilter"
                    class="w-full appearance-none bg-white border border-gray-200 px-2 pr-7 py-2 md:px-4 md:pr-9 md:py-3 rounded-lg md:rounded-xl text-xs md:text-sm font-bold text-gray-900 uppercase outline-none cursor-pointer shadow-sm">
                    <option value="">SEMUA ROLE</option>
                    <option value="admin">ADMIN</option>
                    <option value="user">USER</option>
                </select>
                <div
                    class="absolute right-2 md:right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 text-[10px]">
                    ▼
                </div>
            </div>

            <div class="relative flex-[1.5] min-w-[180px]">
                <span class="absolute left-3 md:left-4 top-1/2 -translate-y-1/2 text-gray-400 flex items-center">
                    <x-lucide-search class="w-3.5 h-3.5 md:w-4 md:h-4" />
                </span>
                <input type="text" wire:model.live="search" placeholder="Cari User"
                    class="w-full py-2 px-3 pl-9 md:py-3 md:px-4 md:pl-11 rounded-lg md:rounded-xl border border-gray-200 bg-white text-xs md:text-sm outline-none shadow-sm">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-[repeat(auto-fill,minmax(min(100%,350px),1fr))] gap-3 md:gap-5">
        @forelse ($admins as $admin)
            <div
                class="bg-white rounded-2xl p-4 md:p-6 shadow-md border border-gray-100 flex items-center justify-between transition-all hover:shadow-lg">

                <div class="flex-grow min-w-0 pr-2.5">
                    <h4
                        class="m-0 text-lg font-extrabold text-gray-900 uppercase tracking-wide whitespace-nowrap overflow-hidden text-ellipsis">
                        {{ $admin->nama_lengkap ?? 'USER NAME' }}
                    </h4>
                    <p class="my-1 text-gray-600 text-sm overflow-hidden text-ellipsis whitespace-nowrap">
                        {{ $admin->email }}</p>
                    <div class="mt-2">
                        <span
                            class="bg-gray-900 text-white px-3 py-1 rounded-lg text-[0.65rem] font-extrabold uppercase">
                            {{ $admin->role }}
                        </span>
                    </div>
                </div>

                <div class="flex flex-col gap-2 flex-shrink-0">
                    <a href="/dashboard/users/{{ $admin->id }}/show" wire:navigate title="Detail"
                        class="no-underline bg-gray-50 w-[34px] h-[34px] flex items-center justify-center rounded-xl border border-gray-200 text-gray-900 hover:bg-gray-100 transition-colors">
                        <x-lucide-eye class="w-4 h-4" />
                    </a>
                    <a href="/dashboard/users/{{ $admin->id }}/edit" wire:navigate title="Edit"
                        class="no-underline bg-gray-50 w-[34px] h-[34px] flex items-center justify-center rounded-xl border border-gray-200 text-gray-900 hover:bg-gray-100 transition-colors">
                        <x-lucide-square-pen class="w-4 h-4 text-blue-500" />
                    </a>
                </div>
            </div>
        @empty
            <div
                class="col-[1/-1] text-center py-14 px-5 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <p class="text-gray-400 font-semibold">Data tidak ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>
