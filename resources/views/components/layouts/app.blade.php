<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Outventure - Perlengkapan Outdoor Terbaik' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>

    <livewire:public.template.navbar />
    <main class="w-full min-h-screen ">
        {{ $slot }}
    </main>
    <livewire:public.template.footer />
    @livewireScripts
</body>

</html>
