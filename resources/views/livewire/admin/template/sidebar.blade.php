<aside @class([
    'h-screen fixed shadow-md transition-width duration-300 bg-gray-200',
    $isCollapsed ? 'w-20' : 'w-64',
])>
    <div class="p-6">
        <h1 class="text-green-600 text-2xl font-semibold">{{ $isCollapsed ? 'O' : 'OutVenture' }}</h1>
    </div>

    <div class="mt-8 space-y-2 px-4">

        <a href="{{ route('admin.dashboard') }}" wire:navigate @class([
            'flex items-center space-x-3 p-3 rounded-lg font-semibold overflow-hidden',
            'bg-green-500 text-black shadow-md' => $activeRoute === 'admin.dashboard',
            'text-gray-800 hover:bg-gray-300' => $activeRoute !== 'admin.dashboard',
        ])>
            <x-lucide-layout-dashboard class="shrink-0" />
            <span @class(['transition-all duration-400', 'hidden' => $isCollapsed])>Dashboard</span>
        </a>


        <a href="{{ route('admin.products.index') }}" wire:navigate @class([
            'flex items-center space-x-3 p-3 rounded-lg font-semibold',
            'bg-green-500 text-black shadow-md' => str_starts_with(
                $activeRoute,
                'admin.products'),
            'text-gray-800 hover:bg-gray-300' => !str_starts_with(
                $activeRoute,
                'admin.products'),
        ])>
            <x-lucide-handbag class=" shrink-0" />
            <span @class(['hidden' => $isCollapsed])>Products</span>
        </a>


        <a href="{{ route('admin.categories.index') }}" wire:navigate @class([
            'flex items-center space-x-3 p-3 rounded-lg font-semibold',
            'bg-green-500 text-black shadow-md' => str_starts_with(
                $activeRoute,
                'admin.categories'),
            'text-gray-800 hover:bg-gray-300' => !str_starts_with(
                $activeRoute,
                'admin.categories'),
        ])>
            <x-lucide-library-big class=" shrink-0" />
            <span @class(['hidden' => $isCollapsed])>Categories</span>
        </a>

        <a href="{{ route('admin.brands.index') }}" wire:navigate @class([
            'flex items-center space-x-3 p-3 rounded-lg font-semibold',
            'bg-green-500 text-black shadow-md' => str_starts_with(
                $activeRoute,
                'admin.brands'),
            'text-gray-800 hover:bg-gray-300' => !str_starts_with(
                $activeRoute,
                'admin.brands'),
        ])>
            <x-lucide-library-big class=" shrink-0" />
            <span @class(['hidden' => $isCollapsed])>Brands</span>
        </a>


        <a href="{{ route('admin.sizes.index') }}" wire:navigate @class([
            'flex items-center space-x-3 p-3 rounded-lg font-semibold',
            'bg-green-500 text-black shadow-md' => str_starts_with(
                $activeRoute,
                'admin.sizes'),
            'text-gray-800 hover:bg-gray-300' => !str_starts_with(
                $activeRoute,
                'admin.sizes'),
        ])>
            <x-lucide-library-big class="fill-current shrink-0" />
            <span @class(['hidden' => $isCollapsed])>Sizes</span>
        </a>
    </div>
</aside>
