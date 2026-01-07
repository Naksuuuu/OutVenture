<div class="bg-white p-8 rounded-lg shadow-lg w-96">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-black tracking-tighter uppercase mb-1 text-gray-900">
            OUTVENTURE<span class="text-[10px] align-top ml-0.5 font-bold text-gray-400"></span>
        </h1>
    </div>

    <form wire:submit.prevent="register">
        <div class="space-y-4">

            <div>
                <input type="text" id="nama_lengkap" wire:model="nama_lengkap" placeholder="Nama Lengkap" required
                    class="w-full border border-gray-200 rounded-md py-3.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-black placeholder-gray-400 transition-all">
                @error('nama_lengkap')
                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <input type="email" id="email" wire:model="email" placeholder="Email" required
                    class="w-full border border-gray-200 rounded-md py-3.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-black placeholder-gray-400 transition-all">
                @error('email')
                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <input type="password" id="password" wire:model="password" placeholder="Password" required
                    class="w-full border border-gray-200 rounded-md py-3.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-black placeholder-gray-400 transition-all">
                @error('password')
                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <input type="password" id="password_confirmation" wire:model="password_confirmation"
                    placeholder="Confirm Password" required
                    class="w-full border border-gray-200 rounded-md py-3.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-black placeholder-gray-400 transition-all">
                @error('password_confirmation')
                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                @enderror
            </div>


            <button type="submit"
                class="w-full bg-black hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none transition duration-300">
                Buat Akun
            </button>
        </div>

    </form>

    <div class="flex items-center my-4">
        <div class="flex-grow border-t border-gray-300"></div>
        <span class="flex-shrink-0 mx-4 text-gray-600 text-sm">Atau masuk dengan</span>
        <div class="flex-grow border-t border-gray-300"></div>
    </div>

    <div class="mt-4 my-4">
        <a href="{{ route('google.login') }}"
            class="w-full flex items-center justify-center bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 py-3.5 px-4 rounded-md shadow-sm transition duration-300 text-xs font-bold uppercase tracking-wide">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-4 h-4 mr-3"
                alt="Google">
            Masuk Dengan Google
        </a>
    </div>

    <div class="mt-8 text-center border-t border-gray-100 pt-6">
        <p class="text-gray-500 text-xs uppercase tracking-tight">
            Sudah punya akun?
            <a href="{{ route('auth.login') }}" wire:navigate
                class="text-blue-500 font-black hover:underline ml-1">Masuk</a>
        </p>
    </div>
</div>
