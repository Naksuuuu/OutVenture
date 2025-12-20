<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Laravel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">

    <livewire:admin.sidebar />

    <div x-data="{ isCollapsed: @json(session('sidebar_collapsed', false)) }" @sidebar-toggled.window="isCollapsed = $event.detail.isCollapsed"
        :class="isCollapsed ? 'ml-20' : 'ml-64'" class="transition-margin duration-300">
        @include('components.admin.navbar')

        <main class="min-h-screen w-full">
            @yield('content')
        </main>
    </div>

    @livewireScripts
</body>

</html>
