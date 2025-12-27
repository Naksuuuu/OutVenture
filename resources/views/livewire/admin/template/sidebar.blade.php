<aside
    :class="[
        isCollapsed ? 'md:w-20' : 'md:w-64',
        mobileMenuOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'
    ]"
    class="h-screen fixed left-0 top-0 z-[9999] shadow-md transition-all duration-300 bg-white w-64 flex flex-col justify-between overflow-hidden">
    <div class="flex flex-col h-full overflow-y-auto">
        <div class="p-6 text-center border-b border-gray-100">
            <h1 class="text-black text-3xl font-bold">
                <span :class="isCollapsed ? '' : 'hidden'">O</span>
                <span :class="isCollapsed ? 'hidden' : ''">Outventure</span>

            </h1>
        </div>

        <div class="mt-8 space-y-2 px-4 flex-1">
            @foreach ($menuItems as $item)
                @php
                    $isActive = $item['matchExact']
                        ? $activeRoute === $item['route']
                        : str_starts_with($activeRoute, str_replace('.index', '', $item['route']));
                @endphp

                <a href="{{ route($item['route']) }}" wire:navigate @class([
                    'flex items-center space-x-3 p-3 rounded-lg font-semibold overflow-hidden group transition-all',
                    'bg-black text-white shadow-md' => $isActive,
                    'text-gray-800 hover:bg-gray-200' => !$isActive,
                ])>
                    <x-dynamic-component :component="'lucide-' . $item['icon']" class="shrink-0 w-6 h-6" />
                    <span :class="isCollapsed ? 'md:hidden' : ''" class="whitespace-nowrap">
                        {{ $item['label'] }}
                    </span>
                </a>
            @endforeach
        </div>

        <div class="p-4 border-t border-gray-100 bg-gray-50">
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center space-x-3 p-3 rounded-lg font-semibold text-red-600 hover:bg-red-50 hover:text-red-700 transition-all overflow-hidden group">
                    <x-lucide-log-out class="shrink-0 w-6 h-6" />
                    <span :class="isCollapsed ? 'md:hidden' : ''" class="whitespace-nowrap">
                        Logout
                    </span>
                </button>
            </form>
        </div>
    </div>
</aside>
