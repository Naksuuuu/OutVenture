<div class="fixed inset-0 flex justify-center items-center bg-gray-50 overflow-hidden w-full h-[100dvh] p-4 font-sans">
    
    <div class="bg-white w-full max-w-[320px] md:max-w-sm rounded-[2rem] shadow-xl p-6 md:p-10 lg:mt-16 border border-gray-100 mx-auto">

        <div class="text-center mb-5 md:mb-8">
            <h2 class="font-black uppercase m-0 text-gray-900 tracking-wide text-base md:text-2xl">
                Update Access
            </h2>
            <p class="text-gray-500 text-[10px] md:text-sm mt-1">
                Hanya hak akses yang dapat diperbarui
            </p>
        </div>

        <div class="mb-4 md:mb-6 p-3 md:p-4 bg-gray-50 rounded-2xl border border-gray-200">
            <small class="block text-gray-400 font-extrabold text-[10px] uppercase mb-1 tracking-wide">
                User Account
            </small>
            <div class="font-bold text-gray-900 text-[11px] md:text-base break-all leading-tight">
                {{ $admin->email ?? 'admin@outventure.com' }}
            </div>
        </div>

        <div class="mb-6 md:mb-10">
            <label class="block font-extrabold mb-1.5 text-[10px] text-gray-900 uppercase tracking-wide">
                Pilih Role Baru
            </label>
            @if ($admin->role === 'superadmin')
                <p class="text-[10px] text-red-600 mb-2 font-semibold">Role superadmin tidak dapat diubah.</p>
                <div class="inline-block bg-gray-900 text-white px-4 py-1.5 rounded-lg text-xs font-extrabold uppercase">SUPERADMIN</div>
            @else
                <div class="relative">
                    <select wire:model="role"
                        class="w-full px-4 py-2.5 md:py-4 rounded-xl border-2 border-gray-900 bg-white font-extrabold outline-none appearance-none text-xs md:text-base text-gray-900 uppercase">
                        <option value="admin">ADMIN</option>
                        <option value="user">USER</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-900 text-[8px] md:text-[10px]">
                        ▼
                    </div>
                </div>
            @endif
        </div>

        <div class="flex gap-2 md:gap-3 items-center">
            @if ($admin->role !== 'superadmin')
                <button wire:click="update"
                    class="flex-[2] bg-gray-900 text-white border-none py-2.5 md:py-4 rounded-xl font-extrabold cursor-pointer uppercase text-[11px] md:text-sm transition-all hover:bg-black active:scale-95">
                    Simpan
                </button>
            @endif
            <a href="{{ route('admin.users.index') }}"
                class="flex-1 bg-gray-100 text-gray-700 py-2.5 md:py-4 rounded-xl font-extrabold text-center text-[11px] md:text-sm transition-all hover:bg-gray-200">
                Batal
            </a>
        </div>
    </div>
</div>