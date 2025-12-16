@extends('layouts.admin')

@section('content')
@php
    // Data Statistik (Di Laravel nyata, ini datang dari Controller)
    $stats = [
        ['value' => '150', 'label' => 'Total Products'],
        ['value' => '5', 'label' => 'Total Categories'],
        ['value' => '10', 'label' => 'Total Transaction'],
        ['value' => '$150.22', 'label' => 'Monthly Revenue'],
    ];

    // Data Produk Terlaris
    $bestSellingProducts = [
        ['name' => 'Tenda', 'price' => 100, 'image' => 'https://via.placeholder.com/60x60'],
        ['name' => 'Tas', 'price' => 75, 'image' => 'https://via.placeholder.com/60x60'],
    ];

    // Log Aktivitas Admin
    $adminActivity = [
        ['activity' => 'Logged in', 'time' => '1 Hours Ago'],
        ['activity' => 'Update product', 'time' => '1 Hours Ago'],
        ['activity' => 'Added new category', 'time' => '1 Hours Ago'],
    ];
@endphp

<div class="p-8">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @foreach($stats as $stat)
            <div class="bg-gray-200 p-6 rounded-lg shadow-md">
                <p class="text-4xl font-bold text-gray-800">{{ $stat['value'] }}</p>
                <p class="text-gray-600 mt-2">{{ $stat['label'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Best Sellings Product</h3>
                @foreach($bestSellingProducts as $product)
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-16 h-16 rounded object-cover">
                        <div>
                            <p class="text-lg font-medium">{{ $product['name'] }}</p>
                            <p class="text-gray-500">${{ $product['price'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Notification</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <span class="text-red-500 text-xl">⚠️</span>
                        <p class="font-medium">Low Stock</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <input type="radio" checked disabled class="form-radio text-green-500">
                        <p class="font-medium">New Order</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Sales Overview</h3>
                <div class="h-64 flex items-center justify-center bg-gray-50 rounded border border-gray-200">
                    
                    Placeholder Grafik (Anda perlu menggunakan library JS terpisah seperti Chart.js untuk membuat grafik nyata)
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Admin Activity</h3>
                <div class="space-y-2">
                    @foreach($adminActivity as $log)
                        <div class="flex justify-between items-center text-gray-600">
                            <p>{{ $log['activity'] }}</p>
                            <span class="text-sm">{{ $log['time'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection