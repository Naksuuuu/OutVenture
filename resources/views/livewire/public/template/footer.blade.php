<footer class="**bg-gray-800** mt-12 pt-12 pb-6 border-t border-gray-700">
    {{-- Kontainer Footer (Harus sama lebarnya dengan kontainer utama) --}}
    <div class="container mx-auto max-w-6xl px-4">

        {{-- Kolom Footer (3 Kolom) --}}
        <div class="flex flex-wrap justify-between -mx-4 mb-8 text-sm">

            {{-- Kolom Kategori --}}
            <div class="w-full md:w-1/3 px-4 mb-6 md:mb-0 text-left">
                <h5 class="text-base font-bold uppercase mb-4 text-gray-800 tracking-wider">KATEGORI</h5>
                <ul class="space-y-1 text-xs text-gray-600 list-none pl-0">
                    <li><a href="#" class="hover:text-black">TENDA</a></li>
                    <li><a href="#" class="hover:text-black">SEPATU</a></li>
                    <li><a href="#" class="hover:text-black">MATRAS</a></li>
                    <li><a href="#" class="hover:text-black">TAS</a></li>
                    <li><a href="#" class="hover:text-black">JAKET</a></li>
                    <li><a href="#" class="hover:text-black">TOPI</a></li>
                    <li><a href="#" class="hover:text-black">KOMPOR</a></li>
                    <li><a href="#" class="hover:text-black">KURSI LIPAT</a></li>
                    <li><a href="#" class="hover:text-black">SLEEPING BAG</a></li>
                </ul>
            </div>

            {{-- Kolom Brand Pilihan --}}
            <div class="w-full md:w-1/3 px-4 mb-6 md:mb-0 text-left">
                <h5 class="text-base font-bold uppercase mb-4 text-gray-800 tracking-wider">BRAND PILIHAN</h5>
                <ul class="space-y-1 text-xs text-gray-600 list-none pl-0">
                    <li><a href="#" class="hover:text-black">THE NORTH FACE</a></li>
                    <li><a href="#" class="hover:text-black">EIGER</a></li>
                    <li><a href="#" class="hover:text-black">CONSINA</a></li>
                </ul>
            </div>

            {{-- Kolom Customer Service --}}
            <div class="w-full md:w-1/3 px-4 text-left">
                <h5 class="text-base font-bold uppercase mb-4 text-gray-800 tracking-wider">CUSTOMER SERVICE</h5>
                <ul class="space-y-1 text-xs text-gray-600 list-none pl-0">
                    <li><a href="#" class="hover:text-black">KONTAK KAMI</a></li>
                </ul>
            </div>
        </div>

        <hr class="border-gray-300 mb-6">

        {{-- Logo Pembayaran (Terpusat) --}}
        <div class="text-center py-3 flex justify-center items-center space-x-4">
            <img src="{{ asset('storage/logobca.jpg') }}" alt="BCA" class="h-6">
            <img src="{{ asset('storage/logomandiri.jpg') }}" alt="Mandiri" class="h-6">
            <img src="{{ asset('storage/logoqris.jpg') }}" alt="QRIS" class="h-6">
            <img src="{{ asset('storage/logogopay.jpg') }}" alt="Gopay" class="h-6">
            <img src="{{ asset('storage/logodana.jpg') }}" alt="Dana" class="h-6">
        </div>

        <p class="text-center text-gray-500 text-xs mt-6">
            2025 OutVenture Copyright
        </p>
    </div>
</footer>
