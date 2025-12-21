<aside @class([
    'h-screen fixed shadow-md transition-width duration-300 bg-gray-200',
    $isCollapsed ? 'w-20' : 'w-64',
])>
    <div class="p-6">
        <h1 class="text-green-600 text-2xl font-semibold">{{ $isCollapsed ? 'O' : 'OutVenture' }}</h1>
    </div>

    <div class="mt-8 space-y-2 px-4">
        
        <a href="{{ route('admin.dashboard') }}" @class([
            'flex items-center space-x-3 p-3 rounded-lg font-semibold overflow-hidden',
            'bg-green-500 text-black shadow-md' => $activeRoute === 'admin.dashboard',
            'text-gray-800 hover:bg-gray-300' => $activeRoute !== 'admin.dashboard',
        ])>
            <x-eos-home class="h-6 w-6 fill-current shrink-0" />
            <span @class(['transition-all duration-400', 'hidden' => $isCollapsed])>Dashboard</span>
        </a>

        
        <a href="{{ route('admin.products.index') }}" @class([
            'flex items-center space-x-3 p-3 rounded-lg font-semibold',
            'bg-green-500 text-black shadow-md' => str_starts_with($activeRoute, 'admin.products'),
            'text-gray-800 hover:bg-gray-300' => !str_starts_with($activeRoute, 'admin.products'),
        ])>
            <x-heroicon-o-shopping-bag class="h-6 w-6 shrink-0" />
            <span @class(['hidden' => $isCollapsed])>Products</span>
        </a>

        
        <a href="{{ route('admin.categories.index') }}" @class([
    'flex items-center space-x-3 p-3 rounded-lg font-semibold',
    'bg-green-500 text-black shadow-md' => str_starts_with($activeRoute, 'admin.categories'),
    'text-gray-800 hover:bg-gray-300' => !str_starts_with($activeRoute, 'admin.categories'),
])>
    <x-heroicon-o-squares-2x2 class="h-6 w-6 shrink-0" />
    <span @class(['hidden' => $isCollapsed])>Categories</span>
</a>
    </div>
</aside>