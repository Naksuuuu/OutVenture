<div class="py-12 px-4 sm:px-6">
    <div class="mx-auto">

        <div
            class="bg-white rounded-3xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden">

            <div
                class="glass-header px-8 py-8 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-black rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                            Edit Category</h1>
                        <p class="text-sm text-slate-500 mt-1">{{ $category->nama_category }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-10">

                <form wire:submit.prevent="update">
                    <section>
                        <div class="flex items-center space-x-2 mb-6">
                            <span class="text-indigo-600 font-bold text-lg">01</span>
                            <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                                Informasi Category
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div class="md:col-span-4">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Nama
                                    Category
                                </label>
                                <input wire:model="nama_category" type="text"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium">
                                @error('nama_category')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="md:col-span-4">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Kategori</label>
                                <select wire:model="id_size_group"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 appearance-none font-medium cursor-pointer">
                                    <option value="" selected>Pilih Size Group</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}"
                                            {{ $category->id_size_group == $size->id ? 'selected' : '' }}>
                                            {{ $size->nama_group }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_size_group')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="md:col-span-4">
                                <label
                                    class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">New
                                    Image
                                </label>
                                <input wire:model="new_image" type="file"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium">
                                @error('new_image')
                                    <span
                                        class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($new_image)
                                <div class="md:col-span-2">
                                    <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                        New Image
                                    </p>

                                    <img src="{{ $new_image->temporaryUrl() }}"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                        alt="{{ $category->nama_category }}">
                                </div>
                            @endif

                            <div class="md:col-span-2">
                                <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                    Image
                                </p>

                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                        alt="{{ $category->nama_category }}">
                                @elseif (!$category->image)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </section>

                    <div class="flex items-center justify-end px-8 py-6">
                        <button type="submit"
                            class="bg-black/80 cursor-pointer hover:bg-black text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-xl shadow-indigo-200 transition-all active:scale-95">
                            Simpan Perubahan Produk
                        </button>
                    </div>
                </form>






            </div>

            <div class="bg-slate-50/80 px-8 py-6 flex items-center border-t border-slate-100">
                <a href="{{ route('admin.categories.index') }}" wire:navigate
                    class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
            &copy; 2025 Praktikum Web &bull; Management System
        </p>
    </div>
