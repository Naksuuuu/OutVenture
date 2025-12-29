<div class="mx-auto">


    <x-ui.page-header title="Pengguna & Admin" subtitle="Kelola pengguna dan administrator sistem Anda."
        class="lg:items-center mb-6 md:mb-10">
        <x-slot:actions>
            <livewire:ui.dropdown wire:model.live="roleFilter" :options="['' => 'Role', 'admin' => 'Admin', 'user' => 'User']" width="w-full sm:w-40" />
            <livewire:ui.dropdown wire:model.live="sort" :options="['' => 'Sort', 'latest' => 'Terbaru', 'oldest' => 'Terlama']" class="" />


            <x-ui.search-input model="search" placeholder="Cari pengguna atau admin..." width="" />


        </x-slot:actions>
    </x-ui.page-header>

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
