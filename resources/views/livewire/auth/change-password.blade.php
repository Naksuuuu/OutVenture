<div class="bg-white p-10 rounded-xl shadow-sm border border-gray-100 w-96 font-sans">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 leading-tight uppercase tracking-tight">Ganti Password</h2>
        <p class="text-gray-500 text-sm mt-1 uppercase text-[10px] font-medium tracking-wider">Ubah password anda!</p>
    </div>



    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md relative mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif


    <form wire:submit.prevent="updatePassword">
        <div class="space-y-4">
            <div>
                <input type="password" id="current_password" wire:model="current_password" placeholder="Password Lama"
                    required
                    class="w-full border border-gray-200 rounded-md py-3.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-black placeholder-gray-400 transition-all">
                @error('current_password')
                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                @enderror
            </div>



            <div>
                <input type="password" id="new_password" wire:model="new_password" placeholder="Password Baru" required
                    class="w-full border border-gray-200 rounded-md py-3.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-black placeholder-gray-400 transition-all">
                @error('new_password')
                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <input type="password" id="new_password_confirmation" wire:model="new_password_confirmation"
                    placeholder="Konfirmasi Password Baru" required
                    class="w-full border border-gray-200 rounded-md py-3.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-black placeholder-gray-400 transition-all">
                @error('new_password_confirmation')
                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" wire:loading.remove
                class="w-full bg-black hover:bg-neutral-500 text-white font-bold py-3.5 px-4 rounded-md transition duration-300 uppercase text-xs tracking-[0.2em]">
                Simpan
            </button>
            <button type="submit" wire:loading
                class="w-full bg-black hover:bg-neutral-500 text-white font-bold py-3.5 px-4 rounded-md transition duration-300 uppercase text-xs tracking-[0.2em]">
                Simpan
            </button>
        </div>

    </form>

    <div class="mt-8 text-center border-t border-gray-100 pt-6">
        <p class="text-gray-500 text-xs uppercase tracking-tight">
            Belum punya akun?
            <a href="{{ route('user.profile') }}" wire:navigate
                class="text-blue-500 font-black hover:underline ml-1">Kembali</a>
        </p>
    </div>
</div>
