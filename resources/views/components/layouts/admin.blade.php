<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ $title ?? 'Admin - Outventure' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100" x-data="{ mobileMenuOpen: false, isCollapsed: @json(session('sidebar_collapsed', false)) }">

    <livewire:admin.template.sidebar />

    <div x-show="mobileMenuOpen" x-transition.opacity @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-black/50 z-[9998] md:hidden">
    </div>

    <div :class="isCollapsed ? 'md:ml-20' : 'md:ml-64'" class="transition-all duration-300 min-h-screen">

        <livewire:admin.template.navbar />

        <main class="p-4">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>

</html>
