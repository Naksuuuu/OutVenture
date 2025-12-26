<div class="p-8 bg-slate-50/50 min-h-screen font-sans">
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Dasbor</h2>
            <p class="text-slate-500 mt-2 font-medium text-lg">
                Selamat datang kembali, <span
                    class="text-slate-900 font-bold underline decoration-emerald-400 decoration-2">{{ Auth::user()->nama_lengkap }}</span>.
            </p>
        </div>
        <div class="hidden md:block">
            <div
                class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl border border-slate-200 shadow-sm transition-all hover:shadow-md">
                <span class="relative flex h-3 w-3">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-sm font-bold text-slate-500 uppercase tracking-widest">Update:
                    {{ now()->format('d M Y, H:i') }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <div
            class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div
                class="p-4 bg-blue-50 rounded-2xl text-blue-600 w-fit group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                <x-lucide-handbag class="w-6 h-6" />
            </div>
            <div class="mt-6">
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Total Produk</p>
                <h3 class="text-4xl font-black text-slate-800 mt-2">{{ $totalProducts }}</h3>
            </div>
        </div>

        <div
            class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div
                class="p-4 bg-purple-50 rounded-2xl text-purple-600 w-fit group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
            </div>
            <div class="mt-6">
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Total Kategori</p>
                <h3 class="text-4xl font-black text-slate-800 mt-2">{{ $totalCategories }}</h3>
            </div>
        </div>

        <div
            class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div
                class="p-4 bg-orange-50 rounded-2xl text-orange-600 w-fit group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                <x-lucide-shopping-cart class="w-6 h-6" />
            </div>
            <div class="mt-6">
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Total Transaksi</p>
                <h3 class="text-4xl font-black text-slate-800 mt-2">{{ $totalTransaksi }}</h3>
            </div>
        </div>

        <div
            class="bg-emerald-600 p-7 rounded-[2rem] shadow-lg shadow-emerald-200 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="relative z-10">
                <div class="p-4 bg-white/20 backdrop-blur-md rounded-2xl text-white w-fit border border-white/20">
                    <x-lucide-circle-dollar-sign class="w-6 h-6" />
                </div>
                <div class="mt-6">
                    <p class="text-xs font-black text-emerald-100 uppercase tracking-[0.2em]">Total Pendapatan</p>
                    <h3 class="text-2xl font-black text-white mt-2">
                        {{ Number::currency($totalPendapatan, 'IDR', 'id', precision: 0) }}
                    </h3>
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm">
                <h3
                    class="text-xl font-black text-slate-900 mb-8 border-l-4 border-emerald-500 pl-4 uppercase tracking-tighter">
                    Paling Laris</h3>
                <div class="space-y-6">
                    @forelse ($bestSellingProducts as $productVariant)
                        <div class="flex items-center group cursor-pointer transition-all hover:translate-x-1">
                            <div
                                class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center border border-slate-100 group-hover:bg-emerald-50 group-hover:border-emerald-100 transition-all overflow-hidden mr-4 shadow-sm">
                                @if ($productVariant->image)
                                    <img src="{{ asset('storage/tenda.jpg') }}"
                                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                @else
                                    <x-lucide-image class="text-slate-300" />
                                @endif
                            </div>
                            <div class="flex-1 border-b border-slate-50 pb-3">
                                <p
                                    class="text-sm font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors tracking-tight">
                                    {{ $productVariant->product->nama_product }}</p>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">
                                    {{ $productVariant->product->brand->nama_brand }}</p>
                            </div>
                            <div class="text-right border-b border-slate-50 pb-3 pl-4">
                                <p class="text-sm font-black text-slate-900">{{ $productVariant->total_terjual ?? 0 }}
                                </p>
                                <p class="text-[10px] font-black text-slate-400 uppercase">Unit</p>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 bg-slate-50 rounded-xl text-center italic text-slate-400 text-sm">Belum ada data
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm">
                <h3 class="text-xl font-black text-slate-900 mb-8 uppercase tracking-tighter">Notifikasi</h3>
                <div class="space-y-4">
                    <div class="p-5 bg-red-50/70 rounded-3xl border border-red-100 transition-colors hover:bg-red-50">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-white text-red-600 rounded-xl flex items-center justify-center shadow-sm font-bold border border-red-100">
                                !</div>
                            <div class="flex-1">
                                <p class="text-sm font-black text-red-900 uppercase tracking-tighter leading-none">Stok
                                    Rendah</p>
                            </div>
                        </div>
                        <div class="mt-4 space-y-3">
                            @forelse($lowStockItems as $spec)
                                <div
                                    class="flex items-center justify-between px-3 py-2 rounded-xl bg-white/60 border border-red-100">
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-slate-800">
                                            {{ $spec->variant->product->nama_product }}</p>
                                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">
                                            • {{ $spec->variant->product->brand->nama_brand }}
                                        </p>
                                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">
                                            • {{ $spec->variant->color->nama_warna }}
                                        </p>
                                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">
                                            • {{ $spec->size->label_size }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-black text-red-600">{{ $spec->stok }}</p>
                                        <p class="text-[10px] font-black text-red-500 uppercase">Stok</p>
                                    </div>
                                </div>
                            @empty
                                <div class="px-3 py-2 rounded-xl bg-slate-50 text-center text-slate-400 text-sm">Tidak
                                    ada stok rendah.</div>
                            @endforelse
                        </div>
                    </div>

                    @if($latestOrder)
                    <div
                        class="flex items-start p-5 bg-emerald-50/70 rounded-3xl border border-emerald-100 transition-colors hover:bg-emerald-50">
                        <div
                            class="w-10 h-10 bg-white text-emerald-600 rounded-xl flex items-center justify-center mr-4 shadow-sm border border-emerald-100">
                            <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></div>
                        </div>
                        <div>
                            <p class="text-sm font-black text-emerald-900 uppercase tracking-tighter">Pesanan Baru</p>
                            <p class="text-xs font-bold text-emerald-600/80 mt-1">Order dari {{ $latestOrder->user->nama_lengkap }}.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-10">
            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden">
                <div class="flex items-center justify-between mb-10 relative z-10">
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">Ikhtisar Penjualan</h3>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Volume unit terjual
                        </p>
                    </div>
                    <select
                        class="text-xs font-black border-slate-200 rounded-xl bg-slate-50 text-slate-600 outline-none p-3 hover:bg-slate-100 transition-colors shadow-sm">
                        <option>Last 6 Months</option>
                    </select>
                </div>
                <div class="h-80 relative z-10" wire:ignore x-data="{
                    init() {
                        new Chart($refs.salesCanvas, {
                            type: 'bar',
                            data: {
                                labels: @js($salesLabels),
                                datasets: [{
                                    label: 'Penjualan',
                                    data: @js($salesData),
                                    backgroundColor: '#10b981',
                                    hoverBackgroundColor: '#059669',
                                    borderRadius: 12,
                                    barThickness: 40,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    y: { grid: { color: '#f1f5f9', drawBorder: false }, border: { display: false } },
                                    x: { grid: { display: false } }
                                }
                            }
                        });
                    }
                }">
                    <canvas x-ref="salesCanvas"></canvas>
                </div>
            </div>

            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">Tren Pendapatan</h3>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Pertumbuhan Financial
                        </p>
                    </div>
                </div>
                <div class="h-80" wire:ignore x-data="{
                    init() {
                        new Chart($refs.revenueCanvas, {
                            type: 'line',
                            data: {
                                labels: @js($revenueLabels),
                                datasets: [{
                                    label: 'Pendapatan',
                                    data: @js($revenueData),
                                    borderColor: '#10b981',
                                    backgroundColor: (context) => {
                                        const chart = context.chart;
                                        const { ctx, chartArea } = chart;
                                        if (!chartArea) return null;
                                        const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                                        gradient.addColorStop(0, 'rgba(16, 185, 129, 0)');
                                        gradient.addColorStop(1, 'rgba(16, 185, 129, 0.15)');
                                        return gradient;
                                    },
                                    borderWidth: 5,
                                    tension: 0.4,
                                    fill: true,
                                    pointBackgroundColor: '#ffffff',
                                    pointBorderColor: '#10b981',
                                    pointBorderWidth: 3,
                                    pointRadius: 6,
                                    pointHoverRadius: 8
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    y: { beginAtZero: true, grid: { color: '#f1f5f9', drawBorder: false }, border: { display: false } },
                                    x: { grid: { display: false } }
                                }
                            }
                        });
                    }
                }">
                    <canvas x-ref="revenueCanvas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
