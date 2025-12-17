<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Tetap pertahankan transisi CSS */
        .transition-width { transition: width 0.3s ease; }
        .transition-margin { transition: margin-left 0.3s ease; }
    </style>
    @livewireStyles 
</head>
<body class="bg-gray-100">

    <livewire:sidebar/>

    <div 
        @class([
            'transition-margin',
            // Gunakan Livewire state untuk menentukan margin
            'ml-20' => session('sidebar_collapsed', false), // Jika collapsed
            'ml-64' => !session('sidebar_collapsed', false), // Jika normal
        ])
    >
        @include('components.admin.navbar')
        
        <main class="min-h-screen">
            @yield('content')
        </main>
    </div>

    @livewireScripts
</body>
</html>