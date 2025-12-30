<div class="py-8 md:py-12 px-4 sm:px-6">
    <div class="mx-auto">
        <div
            class="bg-white rounded-3xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden">

            <div
                class="glass-header px-4 md:px-8 py-6 md:py-8 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center space-x-2 md:space-x-4">
                    <div
                        class="w-10 h-10 md:w-12 md:h-12 bg-black rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold tracking-tight text-slate-800">
                            Create Product</h1>
                        <p class="text-slate-500 text-sm mt-1">Fill in the form below to add a new product.
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="saveProduct">
                <div class="p-4 md:p-8 lg:p-10 space-y-6 md:space-y-10">

                    <section>
                        <div class="flex items-center space-x-2 mb-6">
                            <span class="text-indigo-600 font-bold text-base md:text-lg">01</span>
                            <h2 class="text-base md:text-lg font-bold text-slate-800 uppercase tracking-wide">
                                Product Information
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-8">
                            <div class="md:col-span-4">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Product
                                    Name</label>
                                <input type="text" wire:model.live="nama_product"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                    placeholder="e.g., GORE-TEX Waterproof Jacket">
                                @error('nama_product')
                                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
                            <div>
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Brand</label>
                                <select wire:model="id_brand"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 appearance-none font-medium cursor-pointer">
                                    <option value="" disabled>Pilih Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">
                                            {{ $brand->nama_brand }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_brand')
                                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Category</label>
                                <div class="relative">
                                    <select wire:model="id_category"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 appearance-none font-medium cursor-pointer">
                                        <option value="" disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->nama_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('id_category')
                                    <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="md:col-span-4">
                            <label
                                class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Short
                                Description</label>
                            <textarea wire:model="deskripsi" rows="4"
                                class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 font-medium"></textarea>
                            @error('deskripsi')
                                <span class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                            @enderror
                        </div>
                </div>
                </section>

                <div class="flex items-center justify-center px-4 md:px-8 py-4 md:py-6">
                    <x-ui.button type="submit" variant="create" label="Save Product"
                        class="px-6 md:px-8 py-3 md:py-4 shadow-xl shadow-blue-200" />
                </div>
            </form>

            <div class="bg-slate-50/80 px-4 md:px-8 py-4 md:py-6 flex items-center border-t border-slate-100">
                <x-ui.back-link href="{{ route('admin.products.index') }}" wire:navigate label="Kembali"
                    class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group" />
            </div>
        </div>
    </div>

    <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
        &copy; 2025 Praktikum Web &bull; Management System
    </p>
</div>