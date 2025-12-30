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
                class="rounded-2xl hover:shadow-lg hover:-translate-y-2 transition-all duration-300 group border-slate-200">
                <x-slot:header class="bg-indigo-50/50 border-b border-indigo-100/50 p-4">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-3">
                            <div
                                class="p-2.5 bg-white rounded-xl shadow-sm border border-indigo-100 group-hover:border-indigo-200 transition-colors">
                                <x-lucide-user class="w-5 h-5 text-indigo-600" />
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-sm leading-tight line-clamp-1">
                                    {{ $admin->nama_lengkap ?? 'User System' }}
                                </h3>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">{{ $admin->email }}</p>
                            </div>
                        </div>

                        @if ($admin->role == 'admin')
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Admin
                            </span>
                        @elseif ($admin->role == 'superadmin')
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide bg-slate-900 text-white border border-slate-700">
                                <x-lucide-shield-check class="w-3 h-3" />
                                Super
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide bg-slate-100 text-slate-500 border border-slate-200">
                                <x-lucide-user class="w-3 h-3" />
                                User
                            </span>
                        @endif
                    </div>
                </x-slot:header>

                <div class="p-5 space-y-4">
                    <div class="space-y-3">
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] uppercase tracking-wider text-slate-400 font-bold">Alamat</span>
                            <p class="text-sm font-medium text-slate-700 line-clamp-2 min-h-10">
                                {{ $admin->alamat ?: '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-2 pt-4 border-t border-slate-50">
                        <x-ui.link href="{{ route('admin.users.edit', $admin->id) }}" label="Edit Akses" size="md"
                            variant="update" class="flex-1" icon="settings-2" />
                        <x-ui.link href="{{ route('admin.users.show', $admin->id) }}" size="md" icon="eye" variant="info" />
                    </div>
                </div>
            </x-ui.card-item>
        @empty
            <div class="col-span-full text-center py-14 px-5 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <p class="text-gray-400 font-semibold">Data tidak ditemukan.</p>
            </div>
        @endforelse
    </div>
</div>