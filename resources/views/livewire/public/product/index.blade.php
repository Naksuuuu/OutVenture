 {{-- @php
     $categories = [
         ['name' => 'TENDA', 'image' => 'images/tenda.jpg'],
         ['name' => 'SEPATU', 'image' => 'images/sepatuhiking.jpg'],
         ['name' => 'MATRAS', 'image' => 'images/matras.jpg'],
         ['name' => 'TAS', 'image' => 'images/tas.jpg'],
         ['name' => 'JAKET', 'image' => 'images/gorpcore.jpg'],
         ['name' => 'TOPI', 'image' => 'images/topi.jpg'],
         ['name' => 'KOMPOR', 'image' => 'images/kompor.jpg'],
         ['name' => 'KURSI LIPAT', 'image' => 'images/kursilipat.jpg'],
         ['name' => 'SLEEPING BAG', 'image' => 'images/sleepingbag.jpg'],
         ['name' => 'MEJA LIPAT', 'image' => 'images/mejalipat.jpg'],
     ];
 @endphp --}}




 <div class="w-full flex flex-col items-center gap-20">


     <div class="w-full border-t border-b border-gray-500 bg-white">
         <div class="w-full px-4 md:px-10 py-4">
             <div class="flex flex-wrap items-center gap-x-8 gap-y-4">
                 @php
                     $filters = ['CATEGORY', 'BRAND'];
                 @endphp

                 @foreach ($filters as $filter)
                     <button class="group flex items-center gap-2">
                         <span class="text-sm font-bold uppercase tracking-tight text-black">{{ $filter }}</span>
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                             stroke="currentColor" class="w-3.5 h-3.5 transition-transform group-hover:rotate-180">
                             <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                         </svg>
                     </button>
                 @endforeach
             </div>
         </div>
     </div>

     <div class="w-full px-4 md:px-10 py-12 bg-white">
         <h3 class="text-xl font-bold uppercase mb-6 tracking-tight">PRODUK TERBARU</h3>

         <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
             {{-- @php
             $products = [
                 [
                     'name' => 'Men Mountain Light Triclimate® GORE-TEX® Jacket',
                     'brand' => 'THE NORTH FACE',
                     'price' => '1.299.000',
                     'image' => 'images/jakettnf.jpg',
                     'is_sale' => true,
                 ],
                 [
                     'name' => 'Men Antora Jacket—Print',
                     'brand' => 'THE NORTH FACE',
                     'price' => '1.299.000',
                     'image' => 'images/jakettnf2.jpg',
                     'is_sale' => true,
                 ],
                 [
                     'name' => 'Men Glacier Fleece Vest',
                     'brand' => 'THE NORTH FACE',
                     'price' => '1.299.000',
                     'image' => 'images/vesttnf.jpg',
                     'is_sale' => true,
                 ],
                 [
                     'name' => 'Men Classic Down Jacket',
                     'brand' => 'THE NORTH FACE',
                     'price' => '1.299.000',
                     'image' => 'images/jakettnf3.jpg',
                     'is_sale' => true,
                 ],
                 [
                     'name' => 'Men TNF™ Performance Fleece SW Pants',
                     'brand' => 'THE NORTH FACE',
                     'price' => '1.299.000',
                     'image' => 'images/celanatnf.jpg',
                     'is_sale' => true,
                 ],
             ];
         @endphp --}}

             @foreach ($products as $product)
                 <a href="{{ route('products.show', $product->id) }}" wire:navigate class="flex flex-col">
                     <div class="relative aspect-[4/5] bg-[#f2f2ed] mb-3 overflow-hidden">
                         <img src="{{ asset('images/jakettnf2.jpg') }}" alt="{{ $product->nama_product }}"
                             class="w-full h-full object-cover">
                     </div>

                     <div class="flex flex-col">
                         <span class="text-[10px] font-bold text-black tracking-tight uppercase mb-0.5">
                             {{ $product->brand->nama_brand }}
                         </span>

                         <h4 class="text-[13px] font-medium leading-tight text-black mb-1 uppercase tracking-tighter">
                             {{ $product->nama_product }}
                         </h4>

                         <p class="text-[11px] text-gray-500 mb-1">Available in {{ $product->variants->count() }}
                             Variants</p>

                         <div class="text-[13px] font-bold">
                             <span class="text-gray-500 mr-1 font-normal">From</span>
                             {{ Number::currency($product->variants->flatMap->specs->min('harga'), 'IDR', 'id', precision: 0) }}
                         </div>

                         @if ($product['is_sale'])
                             <div class="mt-3">
                                 <span class="bg-gray-800 text-white text-[10px] font-bold px-3 py-1.5 uppercase">
                                     SALE
                                 </span>
                             </div>
                         @endif
                     </div>
                 </a>
             @endforeach
         </div>
     </div>

 </div>
