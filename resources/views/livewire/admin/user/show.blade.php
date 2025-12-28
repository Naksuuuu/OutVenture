<div class="p-4 md:p-12 flex justify-center bg-gray-50 min-h-screen">
    <div class="bg-white w-full max-w-md rounded-3xl shadow-xl border border-gray-100 overflow-hidden h-fit">

        <div class="bg-gray-900 p-5 md:p-10 relative flex items-center gap-5">
            <div
                class="w-14 h-14 md:w-20 md:h-20 bg-white rounded-full flex items-center justify-center shadow-lg flex-shrink-0">
                <span class="text-2xl md:text-3xl font-black text-gray-900">
                    {{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}
                </span>
            </div>

            <div class="text-left">
                <h3 class="m-0 font-black uppercase text-white tracking-wide text-base md:text-xl leading-tight">Detail
                    User</h3>
                <p class="text-white/60 text-xs mt-1">Data lengkap administrator</p>
            </div>
        </div>

        <div class="p-6 md:p-10">
            <div class="text-left">
                <div class="mb-6 border-b border-gray-50 pb-4">
                    <label class="block text-gray-400 font-extrabold text-[0.65rem] uppercase mb-1 tracking-wider">Nama
                        Lengkap</label>
                    <div class="font-extrabold text-gray-900 text-base md:text-lg uppercase">
                        {{ $admin->name ?? 'ADMIN' }}</div>
                </div>

                <div class="mb-6 border-b border-gray-50 pb-4">
                    <label
                        class="block text-gray-400 font-extrabold text-[0.65rem] uppercase mb-1 tracking-wider">Alamat
                        Email</label>
                    <div class="font-bold text-gray-900 text-sm md:text-base break-all">
                        {{ $admin->email ?? 'admin@outventure.com' }}</div>
                </div>

                <div class="mb-8 md:mb-10">
                    <label class="block text-gray-400 font-extrabold text-[0.65rem] uppercase mb-2 tracking-wider">Level
                        Akses</label>
                    <div
                        class="inline-block bg-gray-900 text-white px-4 py-1.5 rounded-lg text-xs font-extrabold uppercase">
                        {{ $admin->role ?? 'ADMIN' }}
                    </div>
                </div>
            </div>

            <a href="/dashboard/users" wire:navigate
                class="flex items-center justify-center gap-2.5 no-underline w-full bg-gray-100 text-gray-600 px-4 py-3.5 md:py-4 rounded-xl font-extrabold uppercase text-sm md:text-base transition-all hover:bg-gray-200">
                <span class="text-xl">&larr;</span>
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </div>
</div>
