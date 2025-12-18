{{-- <nav class="w-full">
    <div class="container mx-auto flex items-center justify-between">
        <div>
            logo
        </div>
        <ul class="flex gap-4 items-center">
            <li><a href="#" class="text-gray-700 hover:text-gray-900">Home</a></li>
            <li><a href="#" class="text-gray-700 hover:text-gray-900">Categories</a></li>
            <li><a href="#" class="text-gray-700 hover:text-gray-900">Posts</a></li>
            @guest
                <li>
                    <a href="{{ route('auth.show.login') }}"
                        class="bg-blue-400 py-2 px-4 rounded-lg text-gray-700 hover:text-gray-900">
                        Login
                    </a>
                </li>
            @endguest

            @auth
                </li>
                <li>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-400 py-2 px-4 rounded-lg text-gray-700 hover:text-gray-900">
                            Logout
                        </button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</nav> --}}

<nav class="mb-4 px-4">

    <div class="text-center pt-4">
        <h3 class="text-3xl font-bold uppercase tracking-widest text-gray-800">OUTVENTURE</h3>
    </div>

    <div class="w-full flex justify-between text-sm font-bold text-gray-700 tracking-wider">
        <div class="w-[10%]">
            <form action="">
                <input type="text"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-1 text-sm shadow-sm placeholder-gray-400
                    focus:border-black focus:outline-none focus:ring-1 focus:ring-black"
                    placeholder="Search">
            </form>
        </div>
        <div class="w-[80%] flex justify-center items-center gap-10">
            <a href="#" class="hover:text-black uppercase">PRODUK</a>
            <a href="#" class="hover:text-black uppercase">KATEGORI</a>
            <a href="#" class="hover:text-black uppercase">BRAND PILIHAN</a>
            <a href="#" class="hover:text-black uppercase">SETTINGS</a>
        </div>
        <div class="w-[10%] flex gap-10">
            <a href="#" class="hover:text-black uppercase">
                <x-uiw-user class="w-6 h-6" />
            </a>
            <a href="#" class="hover:text-black uppercase relative">
                <x-bytesize-cart class="w-6 h-6" />
                <span
                    class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    1
                </span>
            </a>
        </div>
    </div>
</nav>
