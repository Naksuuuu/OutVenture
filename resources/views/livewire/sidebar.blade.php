<aside 
    @class([
        'h-screen fixed shadow-md transition-width bg-gray-200',
        // Jika isCollapsed TRUE, gunakan w-20 (kecil)
        'w-20' => $isCollapsed,
        // Jika isCollapsed FALSE, gunakan w-64 (normal)
        'w-64' => !$isCollapsed,
    ])
>
    <div class="p-6">
        <h1 @class(['text-green-600 text-2xl font-semibold', 'hidden' => $isCollapsed])>OutVenture</h1>
        <h1 @class(['text-green-600 text-2xl font-semibold', 'block' => $isCollapsed, 'hidden' => !$isCollapsed])>O</h1>
    </div>

    <nav class="mt-8 space-y-2 px-4">
        
        @php
            // Untuk demonstrasi link aktif yang lebih baik (di dunia nyata gunakan Request::routeIs)
            $activeRoute = 'dashboard';
        @endphp

        <a href="{{ route('admin.dashboard') }}" 
            @class([
                'flex items-center space-x-3 p-3 rounded-lg font-semibold', 
                // Warna aktif
                'bg-green-500 text-black shadow-md' => $activeRoute === 'dashboard',
                // Warna non-aktif
                'text-gray-800 hover:bg-gray-300' => $activeRoute !== 'dashboard',
            ])>
            
            <svg class="h-6 w-6 fill-current flex-shrink-0" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" fill="currentColor"/></svg>
            <span @class(['hidden' => $isCollapsed])>Dashboard</span>
        </a>

        <a href="{{ route('admin.products.index') }}" 
            @class([
                'flex items-center space-x-3 p-3 rounded-lg font-semibold', 
                'bg-green-500 text-black shadow-md' => $activeRoute === 'products',
                'text-gray-800 hover:bg-gray-300' => $activeRoute !== 'products',
            ])>
            <svg class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
            <span @class(['hidden' => $isCollapsed])>Products</span>
        </a>

        </nav>
</aside>
