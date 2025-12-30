<div class="max-w-2xl mx-auto">
    <x-ui.card-item class="rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <x-slot:header class="bg-emerald-600 text-white p-8 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl">
            </div>
            <div class="flex items-center gap-6 relative z-10">
                <div
                    class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-inner border border-white/30">
                    <x-lucide-settings class="w-8 h-8 text-white" />
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-white mb-1">Update Akses</h1>
                    <p class="text-emerald-100 font-medium">Pengaturan hak akses pengguna</p>
                </div>
            </div>
        </x-slot:header>

        <div class="p-8 md:p-10 space-y-10">
            <div class="space-y-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <span
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 font-bold text-sm">01</span>
                    <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">Informasi Akun</h2>
                </div>

                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <x-ui.form.label label="Email Pengguna" class="mb-2" />
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-white flex items-center justify-center border border-slate-200 shadow-sm text-slate-500">
                            <x-lucide-mail class="w-5 h-5" />
                        </div>
                        <p class="text-lg font-bold text-slate-800 break-all">{{ $admin->email }}</p>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <span
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 font-bold text-sm">02</span>
                    <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">Pengaturan Role</h2>
                </div>

                @if ($admin->role === 'superadmin')
                    <div class="bg-amber-50 border-l-4 border-amber-400 p-5 rounded-r-xl">
                        <div class="flex items-start gap-4">
                            <x-lucide-shield-alert class="w-6 h-6 text-amber-500 shrink-0" />
                            <div>
                                <h3 class="font-bold text-amber-800">Akses Terkunci</h3>
                                <p class="text-sm text-amber-700 mt-1">Role <strong>SUPERADMIN</strong> tidak dapat diubah
                                    demi keamanan sistem.</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div>
                        <x-ui.form.label label="Pilih Role Baru" />
                        <x-ui.form.select wire:model="role" class="w-full">
                            <option value="admin">ADMIN</option>
                            <option value="user">USER</option>
                        </x-ui.form.select>

                    </div>
                @endif
            </div>

            @if ($admin->role !== 'superadmin')
                <div class="flex items-center justify-end pt-6 border-t border-slate-100">
                    <x-ui.button wire:click="update" variant="update" size="lg" label="Simpan Perubahan"
                        class="px-10 shadow-emerald-200 shadow-xl" />
                </div>
            @endif
        </div>

        <div class="bg-slate-50 px-8 py-6 flex items-center border-t border-slate-100">
            <x-ui.back-link href="{{ route('admin.users.index') }}" />
        </div>
    </x-ui.card-item>
</div>