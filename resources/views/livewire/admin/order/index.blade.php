<div class="p-8 bg-gray-50/50 min-h-screen">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Orders Management</h2>
            <p class="text-gray-500 mt-1">View and manage all customer orders</p>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:w-80">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <x-lucide-search class="w-4 h-4" />
                </span>
                <input type="text" wire:model.live.debounce="search" placeholder="Search by ID or customer..."
                    class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white shadow-sm transition-all">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Order ID
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Customer
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Order Date
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Total Items
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Total Price
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Payment Status
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <x-lucide-receipt class="h-5 w-5 text-emerald-600" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">#{{ $order->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-900">{{ $order->user->name ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">{{ $order->user->email ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $order->tgl_order->format('d M Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $order->tgl_order->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $order->items->sum('quantity') }}
                                    items</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">Rp
                                    {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($order->status_pembayaran === 'paid')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                        <x-lucide-check-circle class="w-3 h-3 mr-1" />
                                        Paid
                                    </span>
                                @elseif ($order->status_pembayaran === 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <x-lucide-clock class="w-3 h-3 mr-1" />
                                        Pending
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        <x-lucide-x-circle class="w-3 h-3 mr-1" />
                                        {{ ucfirst($order->status_pembayaran) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}" wire:navigate
                                    class="inline-flex items-center px-3 py-1.5 bg-gray-900 hover:bg-gray-800 text-white text-xs font-semibold rounded-lg transition-all shadow-sm">
                                    <x-lucide-eye class="w-3.5 h-3.5 mr-1.5" />
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <x-lucide-package-open class="w-16 h-16 text-gray-300 mb-4" />
                                    <p class="text-gray-500 font-medium">No orders found</p>
                                    <p class="text-sm text-gray-400 mt-1">Orders will appear here when customers make
                                        purchases</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($orders->hasPages())
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
