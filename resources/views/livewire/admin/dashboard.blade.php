<div class="p-8 bg-gray-50 min-h-screen">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
        <p class="text-gray-500">Welcome back! Here's what's happening with your store today.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Products</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">
                        {{ $totalProducts }}
                    </h3>
                </div>
                <span class="text-xl opacity-60">s</span>
            </div>
            <p class="text-xs text-gray-400">s</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Categories</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">
                        {{ $totalCategories }}
                    </h3>
                </div>
                <span class="text-xl opacity-60">s</span>
            </div>
            <p class="text-xs text-gray-400">s</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Transaksi</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">
                        {{ $totalTransaksi }}
                    </h3>
                </div>
                <span class="text-xl opacity-60">s</span>
            </div>
            <p class="text-xs text-gray-400">s</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">
                        {{ Number::currency($totalPendapatan, 'IDR', 'id', precision: 0) }}
                    </h3>
                </div>
                <span class="text-xl opacity-60">s</span>
            </div>
            <p class="text-xs text-gray-400">s</p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm min-h-[397px]">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Best Sellings Product</h3>
                <div class="space-y-4">
                    @foreach ($bestSellingProducts as $product)
                        <div class="flex items-center space-x-4">
                            {{-- <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                class="w-12 h-12 rounded-lg object-cover"> --}}
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">{{ $product['name'] }}</p>
                                <p class="text-sm text-gray-500">${{ $product['price'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm min-h-[397px]">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Notification</h3>
                <div class="space-y-3">
                    <div class="flex items-center p-3 bg-red-50 rounded-lg space-x-3">
                        <span class="text-red-500">⚠️</span>
                        <p class="text-sm font-semibold text-red-700">Low Stock Alert</p>
                    </div>
                    <div class="flex items-center p-3 bg-green-50 rounded-lg space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <p class="text-sm font-semibold text-green-700">New Order Received</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Sales Overview</h3>
                <div class=" p-6 rounded-xl " wire:ignore x-data="{
                    init() {
                        new Chart($refs.salesCanvas, {
                            type: 'bar',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                                datasets: [{
                                    label: 'Sales',
                                    data: @js($salesData),
                                    backgroundColor: '#10b981',
                                    borderRadius: 6,
                                }]
                            },
                            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
                        });
                    }
                }">
                    <div class="h-64">
                        <canvas x-ref="salesCanvas"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Revenue Trend</h3>

                <div class="p-6 rounded-xl " wire:ignore x-data="{
                    init() {
                        new Chart($refs.revenueCanvas, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                                datasets: [{
                                    label: 'Revenue',
                                    data: @js($revenueData),
                                    borderColor: '#10b981',
                                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                    borderWidth: 3,
                                    tension: 0.4,
                                    fill: true,
                                    pointBackgroundColor: '#ffffff',
                                    pointBorderColor: '#10b981',
                                    pointBorderWidth: 2,
                                    pointRadius: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: { y: { beginAtZero: true, grid: { color: '#f3f4f6' } }, x: { grid: { display: false } } }
                            }
                        });
                    }
                }">
                    <div class="h-64">
                        <canvas x-ref="revenueCanvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
