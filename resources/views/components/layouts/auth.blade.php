<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login Outventure' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">

    <main class="min-h-screen w-full flex justify-center items-center">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>
