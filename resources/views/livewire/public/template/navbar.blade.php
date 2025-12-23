<nav class="mb-4 px-4">



    <div class="text-center pt-4">
        <a href="{{ route('home') }}" wire:navigate
            class="text-3xl font-bold uppercase tracking-widest text-gray-800">OUTVENTURE</a>
    </div>

    <div class="relative w-full flex mt-2 p-6 justify-between text-sm font-bold text-gray-700 tracking-wider">
        {{-- <div class="w-full bg-white flex justify-center  absolute z-20">
            <form action="">
                <input type="text"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-1 text-sm shadow-sm placeholder-gray-400
                    focus:border-black focus:outline-none focus:ring-1 focus:ring-black"
                    placeholder="Search">
            </form>
        </div> --}}
        <div class="w-[10%] relative">
            <div class="absolute bg-transparent w-full h-full cursor-text">

            </div>
            <form action="">
                <input type="text"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-1 text-sm shadow-sm placeholder-gray-400
                    focus:border-black focus:outline-none focus:ring-1 focus:ring-black"
                    placeholder="Search">
            </form>
        </div>
        <div class="w-[80%] flex justify-center items-center gap-10">
            <a href="{{ route('home') }}" wire:navigate class="hover:text-black uppercase">home</a>
            <a href="{{ route('products.index') }}" wire:navigate class="hover:text-black uppercase">PRODUK</a>
            <a href="#" wire:navigate class="hover:text-black uppercase">BRAND PILIHAN</a>
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
                    <a href="{{ route('user.profile') }}" wire:navigate
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-black">Profile</a>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-black">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            <a href="{{ route('user.orders.index') }}" class="hover:text-black uppercase relative">
                <x-bytesize-cart class="w-5 h-5" />
                <span
                    class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    1
                </span>
            </a>
        </div>
    </div>
</nav>
