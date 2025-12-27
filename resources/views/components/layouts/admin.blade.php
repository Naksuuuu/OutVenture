<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ $title ?? 'Admin - Outventure' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">

    <livewire:admin.template.sidebar />

    <div x-data="{ isCollapsed: @json(session('sidebar_collapsed', false)) }" @sidebar-toggled.window="isCollapsed = $event.detail.isCollapsed"
        :class="isCollapsed ? 'ml-20' : 'ml-64'" class="transition-margin duration-300">

        <livewire:admin.template.navbar />

        <main class="min-h-screen w-full">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>

</html>
