<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('storage/favicon/tes3.svg') }}">
    <title>{{ $title ?? 'Outventure - Perlengkapan Outdoor Terbaik' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @stack('styles-css')
</head>

<body>

    <livewire:public.template.navbar />

    <main class="w-full min-h-screen pt-16 md:pt-[100px]">
        {{ $slot }}
    </main>

    <livewire:public.template.footer />

    @livewireScripts

    @stack('scripts')
    @stack('body-js')

    @if (session('success'))
        <div class="fixed bottom-10 right-10 p-4 bg-green-500 text-white rounded-lg shadow-lg max-w-sm">
            {{ session('success') }}
        </div>
    @endif

</body>

</html>
