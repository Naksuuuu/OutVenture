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
            <x-ui.card-item
                class="p-3 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                <x-slot:header class="flex flex-col items-start justify-end mb-4">
                    <div class="mt-2 flex w-full justify-between">
                        <p class="text-sm font-semibold">
                            {{ $admin->email ?? 'USER NAME' }}
                        </p>


                        @if ($admin->role == 'admin')
                            <p class="bg-emerald-400 text-white px-3 py-1 rounded-lg text-[0.65rem] font-bold uppercase">
                                {{ $admin->role }}
                            </p>
                        @elseif ($admin->role == 'superadmin')
                            <p class="bg-black text-white px-3 py-1 rounded-lg text-[0.65rem] font-bold uppercase">
                                {{ $admin->role }}
                            </p>
                        @else
                            <p class="bg-yellow-200 text-black px-3 py-1 rounded-lg text-[0.65rem] font-bold uppercase">
                                {{ $admin->role }}
                            </p>
                        @endif


                    </div>


                </x-slot:header>


                <x-slot>
                    <div class="flex flex-col gap-2">
                        <h4 class="text-md overflow-hidden text-ellipsis whitespace-nowrap">
                            Nama: {{ $admin->nama_lengkap }}</h4>
                        <p>Alamat: {{ $admin->alamat }}</p>
                    </div>
                </x-slot>

                <x-slot:footer class="flex gap-2">
                    <x-ui.link href="{{ route('admin.users.edit', $admin->id) }}" label='Edit' size="sm" icon="square-pen"
                        class="flex-1" variant="edit" />
                    <x-ui.link href="{{ route('admin.users.show', $admin->id) }}" size="sm" icon="eye" variant="show" />

                </x-slot:footer>
            </x-ui.card-item>
        @empty
            <div class="col-[1/-1] text-center py-14 px-5 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <p class="text-gray-400 font-semibold">Data tidak ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>