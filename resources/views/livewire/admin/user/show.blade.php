<div class="max-w-2xl mx-auto">
    <x-ui.card-item class="rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <x-slot:header class="bg-black text-white p-8 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl">
            </div>
            <div class="flex items-center gap-6 relative z-10">
                <div
                    class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-lg border-4 border-white/10">
                    <span class="text-3xl font-black text-slate-900">
                        {{ strtoupper(substr($admin->nama_lengkap ?? 'A', 0, 1)) }}
                    </span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-white mb-1">Detail Pengguna</h1>
                    <p class="text-slate-400 font-medium">Informasi lengkap akun administrator</p>
                </div>
            </div>
        </x-slot:header>

        <div class="p-8 md:p-10 space-y-10">
            <div class="space-y-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <span
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-slate-600 font-bold text-sm">01</span>
                    <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">Informasi Pribadi</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <x-ui.form.label label="Nama Lengkap" class="mb-2" />
                        <p class="text-lg font-bold text-slate-800">{{ $admin->nama_lengkap ?? '-' }}</p>
                    </div>

                    <div>
                        <x-ui.form.label label="Email" class="mb-2" />
                        <p class="text-lg font-bold text-slate-800 break-all">{{ $admin->email ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <span
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-slate-600 font-bold text-sm">02</span>
                    <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">Status & Akses</h2>
                </div>

                <div>
                    <x-ui.form.label label="Level Akses" class="mb-3" />
                    @if ($admin->role == 'superadmin')
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-xl font-bold uppercase text-sm shadow-md shadow-slate-200">
                            <x-lucide-shield-check class="w-4 h-4" />
                            <span>Super Admin</span>
                        </div>
                    @elseif ($admin->role == 'admin')
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-xl font-bold uppercase text-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Administrator</span>
                        </div>
                    @else
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-600 border border-slate-200 rounded-xl font-bold uppercase text-sm">
                            <x-lucide-user class="w-4 h-4" />
                            <span>User</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 mt-8">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Terdaftar Sejak</p>
                        <p class="text-sm font-bold text-slate-700 mt-1">
                            {{ $admin->created_at ? $admin->created_at->format('d M Y') : '-' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Terakhir Update</p>
                        <p class="text-sm font-bold text-slate-700 mt-1">
                            {{ $admin->updated_at ? $admin->updated_at->diffForHumans() : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-50 px-8 py-6 flex items-center border-t border-slate-100">
            <x-ui.back-link href="{{ route('admin.users.index') }}" />
        </div>
    </x-ui.card-item>
</div>