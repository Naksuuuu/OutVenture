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
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                            Detail Brand</h1>
                        <p class="text-sm text-slate-500 mt-1">{{ $brand->nama_brand }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-10">

                <section>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-indigo-600 font-bold text-lg">01</span>
                        <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                            Informasi Brand
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="md:col-span-4">
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Nama
                                Brand
                            </p>
                            <h3
                                class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium">
                                {{ $brand->nama_brand }}
                            </h3>
                        </div>

                        <div class="md:col-span-4">
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Status
                            </p>
                            <div class="flex items-center gap-2">
                                @if ($brand->is_trusted)
                                    <span
                                        class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-800 px-4 py-2 rounded-xl font-bold text-sm">
                                        <x-lucide-badge-check class="w-4 h-4" />
                                        Trusted Brand
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2 bg-gray-100 text-gray-800 px-4 py-2 rounded-xl font-bold text-sm">
                                        <x-lucide-circle class="w-4 h-4" />
                                        Regular Brand
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Image
                            </p>
                            @if ($brand->image)
                                <img src="{{ asset('storage/' . $brand->image) }}"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                    alt="{{ $brand->nama_brand }}">
                            @elseif (!$brand->image)
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Wide
                                Image
                            </p>
                            @if ($brand->wide_image)
                                <img src="{{ asset('storage/' . $brand->wide_image) }}"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                    alt="{{ $brand->nama_brand }}">
                            @elseif (!$brand->wide_image)
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">Logo
                            </p>
                            @if ($brand->logo)
                                <img src="{{ asset('storage/' . $brand->logo) }}"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium"
                                    alt="{{ $brand->nama_brand }}">
                            @elseif (!$brand->logo)
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

            </div>

            <div class="bg-slate-50/80 px-8 py-6 flex items-center border-t border-slate-100">
                <a href="{{ route('admin.brands.index') }}" wire:navigate
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
</div>
