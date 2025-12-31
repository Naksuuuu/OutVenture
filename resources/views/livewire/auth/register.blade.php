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

    <a href="{{ route('google.login') }}"
        class="w-full flex items-center justify-center bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-2 px-4 rounded shadow-sm transition duration-300">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_13183_10121)">
                <path
                    d="M20.3081 10.2303C20.3081 9.55056 20.253 8.86711 20.1354 8.19836H10.1704V12.3206H15.9018C15.6835 13.6919 14.9295 14.9232 13.7549 15.7231V18.5205H17.1438C19.1284 16.6533 20.3081 13.8821 20.3081 10.2303Z"
                    fill="#3F7EE8" />
                <path
                    d="M10.1703 20.5378C12.973 20.5378 15.3621 19.5855 17.1478 17.9152L13.7589 15.1178C12.8123 15.7538 11.5859 16.1422 10.1743 16.1422C7.45269 16.1422 5.14088 14.2882 4.30138 11.7584H0.811768V14.4991C2.55167 17.9942 6.13883 20.5378 10.1703 20.5378Z"
                    fill="#34A853" />
                <path
                    d="M4.2974 11.7585C3.85878 10.4326 3.85878 9.00994 4.2974 7.68403V4.94324H0.811797C-0.665241 7.91574 -0.665241 11.5268 0.811797 14.4993L4.2974 11.7585Z"
                    fill="#FBBC05" />
                <path
                    d="M10.1703 4.30331C11.6661 4.28014 13.1118 4.83606 14.2007 5.86766L17.2227 2.80918C15.3087 1.00936 12.7937 0.00350929 10.1703 0.00350929C6.13883 0.00350929 2.55167 2.54714 0.811768 6.04218L4.29739 8.78297C5.13689 6.25315 7.4487 4.30331 10.1703 4.30331Z"
                    fill="#EA4335" />
            </g>
            <defs>
                <clipPath id="clip0_13183_10121">
                    <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                </clipPath>
            </defs>
        </svg>
        Google
    </a>

    <div class="mt-8 text-center border-t border-gray-100 pt-6">
        <p class="text-gray-500 text-xs uppercase tracking-tight">
            Sudah punya akun?
            <a href="{{ route('auth.login') }}" wire:navigate
                class="text-blue-500 font-black hover:underline ml-1">Masuk</a>
        </p>
    </div>
</div>