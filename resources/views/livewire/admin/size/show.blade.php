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
                            Size Group Details</h1>
                        <p class="text-sm text-slate-500 mt-1">{{ $sizeGroup->nama_group }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-10">

                <section>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-indigo-600 font-bold text-lg">01</span>
                        <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                            Group Information
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                Group Name
                            </p>
                            <h3
                                class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-slate-800 shadow-inner focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all duration-300 placeholder:text-slate-400 font-medium">
                                {{ $sizeGroup->nama_group }}
                            </h3>
                        </div>

                        <div>
                            <p class="block text-[13px] font-bold text-slate-600 uppercase mb-2 tracking-wider">
                                Used in Categories
                            </p>
                            <div class="flex items-center gap-2">
                                <span
                                    class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-800 px-4 py-3 rounded-xl font-bold text-sm shadow-inner">
                                    <x-lucide-layers class="w-4 h-4" />
                                    {{ $sizeGroup->categories->count() }} Category(ies)
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-indigo-600 font-bold text-lg">02</span>
                        <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                            Size Values ({{ $sizeGroup->values->count() }})
                        </h2>
                    </div>

                    @if ($sizeGroup->values->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach ($sizeGroup->values as $value)
                                <div
                                    class="bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-center shadow-sm hover:shadow-md transition-all">
                                    <p class="text-lg font-bold text-slate-800">{{ $value->label_size }}</p>
                                    <p class="text-xs text-slate-500 mt-1">Order: {{ $value->sort_order }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="bg-slate-50 border border-slate-200 rounded-2xl px-8 py-12 text-center shadow-inner">
                            <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <p class="text-slate-400 text-sm italic">No size values defined for this group</p>
                        </div>
                    @endif
                </section>

                @if ($sizeGroup->categories->count() > 0)
                    <section>
                        <div class="flex items-center space-x-2 mb-6">
                            <span class="text-indigo-600 font-bold text-lg">03</span>
                            <h2 class="text-lg font-bold text-slate-800 uppercase tracking-wide">
                                Used by Categories
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($sizeGroup->categories as $category)
                                <div
                                    class="bg-white border border-slate-200 rounded-2xl px-5 py-4 shadow-sm hover:shadow-md hover:border-indigo-200 transition-all">
                                    <div class="flex items-center gap-3">
                                        @if ($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                class="w-12 h-12 object-cover rounded-lg" alt="">
                                        @else
                                            <div
                                                class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 font-bold">
                                                {{ strtoupper(substr($category->nama_category, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-slate-800">{{ $category->nama_category }}
                                            </p>
                                            <p class="text-xs text-slate-500">{{ $category->products_count ?? 0 }}
                                                products</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

            </div>

            <div class="bg-slate-50/80 px-8 py-6 flex items-center border-t border-slate-100">
                <a href="{{ route('admin.sizes.index') }}" wire:navigate
                    class="text-slate-500 hover:text-slate-800 text-sm font-bold uppercase tracking-widest transition-colors flex items-center group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <p class="mt-8 text-center text-slate-400 text-xs tracking-wide uppercase">
            &copy; 2025 Praktikum Web &bull; Management System
        </p>
    </div>
</div>
