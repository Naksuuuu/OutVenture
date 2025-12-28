<footer class="bg-[#1a1a1a] text-[#e5e5e5] pt-20 pb-10 overflow-hidden relative">
    <div class="container mx-auto px-6 max-w-7xl relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-20">

            <div class="space-y-8">
                <div class="max-w-xs">
                    <p class="text-lg leading-relaxed font-medium">
                        OutVenture menyediakan perlengkapan outdoor berkualitas, aman, nyaman dengan daya tahan tinggi
                        dan fungsi yang maksimal, siap menemani setiap perjalananmu di alam bebas.
                    </p>
                </div>

                <div class="space-y-4">
                    <h5 class="text-xs uppercase tracking-[0.2em] text-gray-500 font-bold flex items-center">
                        <span class="w-4 h-[1px] bg-gray-500 mr-2"></span> Contact
                    </h5>
                    <div class="text-sm space-y-1 text-gray-400">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=outventureindonesia@gmail.com"
                            target="_blank" class="hover:text-white transition-colors cursor-pointer block">
                            outventureindonesia@gmail.com
                        </a>
                        <p>Bandung, West Java</p>
                        <p>Indonesia</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <nav class="flex flex-col space-y-2">
                    <a href="{{ route('home') }}" wire:navigate
                        class="text-5xl md:text-6xl font-bold hover:text-gray-500 transition-all duration-300">Home</a>
                    <a href="{{ route('products.index') }}" wire:navigate
                        class="text-5xl md:text-6xl font-bold hover:text-gray-500 transition-all duration-300">Produk</a>
                    <a href="{{ route('brands.index') }}" wire:navigate
                        class="text-5xl md:text-6xl font-bold hover:text-gray-500 transition-all duration-300">Brand
                        Pilihan</a>
                </nav>
            </div>

            <div class="flex flex-col items-start md:items-end space-y-2">
                <a href="https://www.instagram.com/outventureindonesia/" target="_blank" rel="noopener noreferrer"
                    class="group flex items-center text-sm font-medium hover:text-gray-400">
                    Instagram <span class="ml-1 opacity-0 group-hover:opacity-100 transition-opacity">↗</span>
                </a>
                <a href="https://wa.me/6282115368087?text=Halo%20OutVenture%2C%20saya%20ingin%20bertanya..."
                    target="_blank" rel="noopener noreferrer"
                    class="group flex items-center text-sm font-medium hover:text-gray-400">
                    WhatsApp <span class="ml-1 opacity-0 group-hover:opacity-100 transition-opacity">↗</span>
                </a>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-end border-t border-gray-800 pt-8 mt-10">
            <div class="text-[10px] uppercase tracking-widest text-gray-600">
                ©2025 OUTVENTURE
            </div>
        </div>
    </div>

    <div class="relative mt-10 select-none pointer-events-none opacity-10 z-0">
        <h1 class="text-[15vw] font-black leading-none tracking-tighter text-center whitespace-nowrap translate-y-10">
            OUTVENTURE
        </h1>
    </div>
</footer>
