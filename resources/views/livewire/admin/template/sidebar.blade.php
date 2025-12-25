<aside @class([
    'h-screen fixed shadow-md transition-width duration-300 ',
    $isCollapsed ? 'w-20' : 'w-64',
])>
    <div class="p-6 text-center">
        <h1 class="text-black text-3xl font-bold">{{ $isCollapsed ? 'O' : 'OutVenture' }}</h1>
    </div>

    <div class="mt-8 space-y-2 px-4">
        @foreach ($menuItems as $item)
            @php
                $isActive = $item['matchExact']
                    ? $activeRoute === $item['route']
                    : str_starts_with($activeRoute, str_replace('.index', '', $item['route']));
            @endphp

            <a href="{{ route($item['route']) }}" wire:navigate @class([
                'flex items-center space-x-3 p-3 rounded-lg font-semibold overflow-hidden',
                'bg-black text-white shadow-md' => $isActive,
                'text-gray-800 hover:bg-gray-300' => !$isActive,
            ])>
                <x-dynamic-component :component="'lucide-' . $item['icon']" class="shrink-0" />
                <span @class(['transition-all duration-400', 'hidden' => $isCollapsed])>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </div>
</aside>
