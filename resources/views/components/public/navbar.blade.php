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
        <a href="/" class="text-3xl font-bold uppercase tracking-widest text-gray-800">OUTVENTURE</a>
    </div>

    <div class="w-full flex mt-2 justify-between text-sm font-bold text-gray-700 tracking-wider">
        <div class="w-[10%]">
            <form action="">
                <input type="text"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-1 text-sm shadow-sm placeholder-gray-400
                    focus:border-black focus:outline-none focus:ring-1 focus:ring-black"
                    placeholder="Search">
            </form>
        </div>
        <div class="w-[80%] flex justify-center items-center gap-10">
            <a href="{{ route('home') }}" class="hover:text-black uppercase">home</a>
            <a href="/products" class="hover:text-black uppercase">PRODUK</a>
            <a href="#" class="hover:text-black uppercase">BRAND PILIHAN</a>
        </div>
        <div class="w-[10%] flex items-center gap-6">

            <div x-data="{ open: false }" class="relative hover:bg-black/10 rounded-md px-3 py-2">

                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center gap-2 hover:text-black uppercase cursor-pointer">
                    <x-uiw-user class="w-5 h-5" />
                    <x-uiw-up class="w-3 h-3 transition-transform duration-200" x-bind:class="{ 'rotate-180': open }" />
                </button>

                <div x-show="open" @click.away="open = false" @mouseleave="open = false" x-transition
                    class="absolute left-1/2 -translate-x-1/2 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-20">
                    <a href="#"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-black">Profile</a>
                    <a href="#"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-black">Settings</a>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-black">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            <a href="#" class="hover:text-black uppercase relative">
                <x-bytesize-cart class="w-5 h-5" />
                <span
                    class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    1
                </span>
            </a>
        </div>
    </div>
</nav>
