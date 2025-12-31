@props(['brands'])

<div class="swiper mySwiper w-full md:h-[600px] h-[450px] relative">
  <div class="swiper-wrapper">
    @forelse ($brands as $brand)
      <div class="swiper-slide relative">
        @if ($brand->wide_image)
          <img src="{{ asset('storage/' . $brand->wide_image) }}" alt="{{ $brand->nama_brand }}"
            class="absolute inset-0 -z-10 h-full w-full object-cover">
        @else
          <div class="absolute inset-0 m-auto w-full h-full flex justify-center items-center flex-col gap-2">
            <x-lucide-image class="h-16 w-16 text-gray-400 " />
            {{ $brand->nama_brand }}
          </div>
        @endif

        <div class="relative p-10 flex flex-col items-center md:items-start md:justify-end w-full h-full bg-black/30">
          <a href="{{ route('brands.show', $brand->slug) }}"
            class="text-2xl md:text-4xl font-extrabold tracking-tight text-white uppercase mb-4">
            {{ $brand->nama_brand }}
          </a>


          <div class="flex space-x-3">
            <a href="{{ route('brands.show', $brand->slug) }}"
              class="block group relative h-10 font-bold overflow-hidden bg-white text-black px-6 uppercase">
              <div class="flex h-10 items-center transition-transform duration-300 group-hover:-translate-y-10">
                {{ $brand->nama_brand }}
              </div>
              <div class="flex h-10 items-center transition-transform duration-300 group-hover:-translate-y-10">
                {{ $brand->nama_brand }}
              </div>
            </a>

            <a href="{{ route('products.index') }}"
              class="block group relative h-10 font-bold overflow-hidden bg-black text-white px-6">
              <div class="flex h-10 items-center transition-transform duration-300 group-hover:-translate-y-10">
                LIHAT PRODUK
              </div>
              <div class="flex h-10 items-center transition-transform duration-300 group-hover:-translate-y-10">
                LIHAT PRODUK
              </div>
            </a>
          </div>
        </div>
      </div>
    @empty
      <div class="swiper-slide bg-black/50 w-full h-full  !flex !justify-center !items-center">
        <h1 class="text-white text-2xl font-bold text-center">BELUM ADA DATA BRAND</h1>
      </div>
    @endforelse
  </div>

  <div class="swiper-pagination !bottom-6"></div>
</div>

@push('body-js')
  <script>
    function initHeroSwiper() {
      new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        // Tambahkan efek fade agar lebih smooth
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
      });
    }

    // Jalankan saat pertama kali load
    document.addEventListener('DOMContentLoaded', initHeroSwiper);

    // Jalankan ulang setelah Livewire melakukan navigasi/update
    document.addEventListener('livewire:navigated', initHeroSwiper);
  </script>
@endpush