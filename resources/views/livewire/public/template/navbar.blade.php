<nav class="mb-4 px-4">
    <div class="text-center pt-4">
        <a href="{{ route('home') }}" wire:navigate
            class="text-3xl font-bold uppercase tracking-widest text-gray-800">OUTVENTURE</a>
    </div>

    <div x-data="{ open: false }" x-effect="if (open) { $nextTick(() => { $refs.searchInput.focus() }) }"
        class="relative w-full h-8 flex mt-2 items-center justify-between text-sm font-bold text-gray-700 tracking-wider">

        <div x-show="open"
            class="w-full left-0 -top-2 bg-white flex justify-center items-center h-10 gap-2 absolute z-30">
            <form action="" class="w-[80%]">
                <input type="text" x-ref="searchInput"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-1 text-sm shadow-sm placeholder-gray-400
                    focus:border-black focus:outline-none focus:ring-1 focus:ring-black"
                    placeholder="Search">
            </form>
            <x-lucide-x class="cursor-pointer" @click="open = false" />
        </div>

        <div class="w-[20%] relative" @click="open = !open">
            <div class="absolute bg-transparent w-full h-full cursor-text"></div>
            <form action="">
                <input type="text"
                    class="w-full rounded-md border border-gray-300 bg-white px-3 py-1 text-sm shadow-sm placeholder-gray-400
                    focus:border-black focus:outline-none focus:ring-1 focus:ring-black"
                    placeholder="Search">
            </form>
        </div>

        <div class="w-[60%] flex justify-center items-center gap-10">
            <a href="{{ route('home') }}" wire:navigate class="hover:text-black uppercase">home</a>
            <a href="{{ route('products.index') }}" wire:navigate class="hover:text-black uppercase">PRODUK</a>
            <a href="{{ route('brands.index') }}" wire:navigate class="hover:text-black uppercase">BRAND PILIHAN</a>
        </div>

        <div class="w-[20%] flex items-center justify-end gap-2">

            <div x-data="{ openUser: false }" class="relative">
                <button @click="openUser = !openUser" @click.away="openUser = false"
                    class="flex items-center gap-1 hover:text-black uppercase cursor-pointer p-1 rounded-md hover:bg-black/5">
                    <x-lucide-user-round class="w-6 h-6" />
                    <x-lucide-chevron-up class="w-3 h-3 transition-transform duration-200"
                        x-bind:class="{ 'rotate-180': openUser }" />
                </button>

                <div x-show="openUser" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                    <a href="{{ route('user.profile') }}" wire:navigate
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 border-b border-gray-50">Profile</a>

                    <a href="{{ route('user.orders.index') }}" wire:navigate
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 border-b border-gray-50">Orders</a>

                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <a href="{{ route('user.orders.index') }}" class="hover:text-black relative p-1">
                <x-lucide-shopping-cart class="w-6 h-6" />
                <span
                    class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">
                    1
                </span>
            </a>
        </div>
    </div>
</nav>
