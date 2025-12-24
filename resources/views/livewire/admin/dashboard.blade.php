<div class="p-8 bg-gray-50/50 min-h-screen font-sans">
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard</h2>
            <p class="text-gray-500 mt-1">Welcome back! {{ Auth::user()->nama_lengkap }}, Here's what's happening with
                your store today.</p>
        </div>
        <div class="hidden md:block">
            <span class="text-sm font-medium text-gray-400">Last updated: {{ now()->format('d M Y, H:i') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                    <x-lucide-handbag />
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Products</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProducts }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-purple-50 rounded-xl text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Categories</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalCategories }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-orange-50 rounded-xl text-orange-600">
                    <x-lucide-shopping-cart />
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Transaksi</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalTransaksi }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                    <x-lucide-circle-dollar-sign />
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">
                    {{ Number::currency($totalPendapatan, 'IDR', 'id', precision: 0) }}
                </h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Best Selling</h3>
                </div>
                <div class="space-y-5">
                    @forelse ($bestSellingProducts as $productVariant)

                        <div class="flex items-center group cursor-pointer">
                            <div
                                class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400 group-hover:bg-emerald-50 group-hover:text-emerald-500 transition-colors mr-4 overflow-hidden">

                                @if ($productVariant->image)
                                    <img src="{{ asset('storage/tenda.jpg') }}"
                                        class="w-6 h-6 object-cover opacity-80 group-hover:opacity-90 transition duration-300"
                                        alt="">
                                @elseif (!$productVariant->image)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 border-b border-gray-50 pb-2">
                                <p class="text-sm font-bold text-gray-800">{{ $productVariant->product->nama_product }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $productVariant->product->brand->nama_brand }}</p>

                            </div>
                            <div class="flex-1 flex justify-end border-b border-gray-50 pb-2">
                                <p class="text-sm font-bold text-gray-800">{{ $productVariant->total_terjual ?? 0 }}
                                    Terjual
                                </p>

                            </div>
                        </div>
                    @empty
                        <div>halo</div>
                    @endempty
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Notifications</h3>
            <div class="space-y-4">
                <div class="flex items-start p-4 bg-red-50/50 rounded-xl border border-red-100">
                    <div
                        class="flex-shrink-0 w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center mr-3">
                        ⚠️
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-800">Low Stock Alert</p>
                        <p class="text-xs text-red-600/80 mt-0.5">3 items are running out of stock.</p>
                    </div>
                </div>
                <div class="flex items-start p-4 bg-emerald-50/50 rounded-xl border border-emerald-100">
                    <div
                        class="flex-shrink-0 w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center mr-3">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-emerald-800">New Order</p>
                        <p class="text-xs text-emerald-600/80 mt-0.5">Order #1294 received just now.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Sales Overview</h3>
                    <p class="text-xs text-gray-500">Monthly sales performance</p>
                </div>
                <select class="text-xs border-gray-200 rounded-lg bg-gray-50 text-gray-600 outline-none p-1">
                    <option>Last 6 Months</option>
                </select>
            </div>
            <div wire:ignore x-data="{
                init() {
                    new Chart($refs.salesCanvas, {
                        type: 'bar',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            datasets: [{
                                label: 'Sales',
                                data: @js($salesData),
                                backgroundColor: '#10b981',
                                hoverBackgroundColor: '#059669',
                                borderRadius: 8,
                                barThickness: 32,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { grid: { color: '#f3f4f6', drawBorder: false } },
                                x: { grid: { display: false } }
                            }
                        }
                    });
                }
            }">
                <div class="h-72">
                    <canvas x-ref="salesCanvas"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Revenue Trend</h3>
                    <p class="text-xs text-gray-500">Revenue growth over time</p>
                </div>
            </div>
            <div wire:ignore x-data="{
                init() {
                    new Chart($refs.revenueCanvas, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            datasets: [{
                                label: 'Revenue',
                                data: @js($revenueData),
                                borderColor: '#10b981',
                                backgroundColor: (context) => {
                                    const chart = context.chart;
                                    const { ctx, chartArea } = chart;
                                    if (!chartArea) return null;
                                    const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                                    gradient.addColorStop(0, 'rgba(16, 185, 129, 0)');
                                    gradient.addColorStop(1, 'rgba(16, 185, 129, 0.1)');
                                    return gradient;
                                },
                                borderWidth: 3,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#ffffff',
                                pointBorderColor: '#10b981',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { beginAtZero: true, grid: { color: '#f3f4f6', drawBorder: false } },
                                x: { grid: { display: false } }
                            }
                        }
                    });
                }
            }">
                <div class="h-72">
                    <canvas x-ref="revenueCanvas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
