<nav class="p-4 fixed w-full z-[9999] bg-white" x-data="{ mobileMenuOpen: false }">
    <div x-show="mobileMenuOpen"
        class="absolute  md:hidden left-0 w-full h-screen flex flex-col items-center justify-center bg-white text-2xl font-semibold gap-4">
        <a href="{{ route('home') }}" wire:navigate class="hover:text-black uppercase">home</a>
        <a href="{{ route('products.index') }}" wire:navigate class="hover:text-black uppercase">PRODUK</a>
        <a href="{{ route('brands.index') }}" wire:navigate class="hover:text-black uppercase">BRAND PILIHAN</a>
    </div>

    <div x-data="{ open: false }" x-effect="if (open) { $nextTick(() => { $refs.searchInput.focus() }) }"
        class="w-full flex items end justify-between">


        <div x-show="open"
            class="w-screen bg-white left-0 top-3 md:top-12  flex-col flex justify-center items-center gap-2 absolute z-50">
            <div class="w-[80%] h-10 flex items-center justify-center gap-2">
                <div class="relative flex-1 md:w-80 group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-black ">
                        <x-lucide-search class="w-4 h-4" />
                    </span>
                    <input type="text" x-ref="searchInput" wire:model.live.debounce="search"
                        placeholder="Cari merek..."
                        class="w-full pl-11 pr-4 py-2 text-sm border-none rounded-2xl bg-gray-100 shadow-md shadow-slate-200/50 focus:ring-2 focus:ring-emerald-500/20 transition-all font-medium">
                </div>
                <x-lucide-x class="cursor-pointer" @click="open = false" />
            </div>
            <div class="relative w-full flex  justify-center">
                @if (!empty($this->products) && count($this->products) > 0)
                    <div
                        class="w-full md:w-[60%] absolute bg-white border border-gray-200 rounded-md shadow-lg max-h-96 overflow-y-auto mb-4">
                        @forelse ($this->products as $product)
                            <a href="{{ route('products.show', $product->id) }}" wire:navigate
                                class="flex items-center gap-4 p-4 hover:bg-gray-50 border-b border-gray-100 last:border-b-0">
                                <div class="w-20 h-24 bg-[#f2f2ed] rounded flex-shrink-0 overflow-hidden">
                                    @if ($product->variants->first() && $product->variants->first()->image)
                                        <img src="{{ asset('storage/' . $product->variants->first()->image) }}"
                                            alt="{{ $product->nama_product }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span
                                        class="text-[10px] font-bold text-black tracking-tight uppercase block mb-0.5">
                                        {{ $product->brand->nama_brand ?? 'Brand' }}
                                    </span>
                                    <h4
                                        class="text-[13px] font-medium leading-tight text-black mb-1 uppercase tracking-tighter truncate">
                                        {{ $product->nama_product }}
                                    </h4>
                                    <p class="text-[11px] text-gray-500 line-clamp-2">
                                        {{ $product->deskripsi }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                <p>Tidak ada produk ditemukan</p>
                            </div>
                        @endforelse
                    </div>
                @endif
            </div>


        </div>


        <div class="md:w-[20%] relative flex items-center gap-3 md:items-end">
            <div class="md:hidden" @click="mobileMenuOpen = !mobileMenuOpen">
                <x-lucide-menu />
            </div>
            <div class="w-fit hidden md:block md:w-full" @click="open = !open, mobileMenuOpen = false">
                <div class="relative flex-1 group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-black ">
                        <x-lucide-search class="w-4 h-4" />
                    </span>
                    <input type="text" wire:model.live.debounce="search" placeholder="Cari merek..."
                        class="w-full pl-11 pr-4 py-2 text-sm border-none rounded-2xl bg-gray-100 shadow-md shadow-slate-200/50 focus:ring-2 focus:ring-emerald-500/20 transition-all font-medium">
                </div>
            </div>

            <x-lucide-search class="md:hidden" @click="open = !open, mobileMenuOpen = false" />

        </div>
        <div class="relative flex-1 flex flex-col gap-2 items-center justify-between">
            <div class="text-center">
                <a href="{{ route('home') }}" wire:navigate
                    class="text-2xl md:text-3xl font-bold uppercase tracking-widest text-gray-800">OUTVENTURE</a>
            </div>
            <div class="hidden md:flex items-center justify-center gap-5 ">
                <a href="{{ route('home') }}" wire:navigate class="hover:text-black uppercase">home</a>
                <a href="{{ route('products.index') }}" wire:navigate class="hover:text-black uppercase">PRODUK</a>
                <a href="{{ route('brands.index') }}" wire:navigate class="hover:text-black uppercase">BRAND
                    PILIHAN</a>
            </div>
        </div>
        <div class="md:w-[20%] flex items-end justify-end gap-2">
            <div x-data="{ openUser: false }" class="relative">
                <button @click="openUser = !openUser" @click.away="openUser = false"
                    class="flex items-center gap-1 hover:text-black uppercase cursor-pointer px-2 py-1 rounded-md hover:bg-black/5">
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

                    @auth

                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                            <a href="{{ route('admin.dashboard') }}" wire:navigate
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 border-b border-gray-50">Admin
                                Dashboard</a>
                        @endif

                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('auth.login') }}"
                            class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                            Login
                        </a>
                    @endguest
                </div>
            </div>

            <a href="{{ route('user.carts.index') }}" class="hover:text-black relative p-1">
                <x-lucide-shopping-cart class="w-6 h-6" />
                @if ($cartCount > 0)
                    <span
                        class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        </div>
    </div>


</nav>
