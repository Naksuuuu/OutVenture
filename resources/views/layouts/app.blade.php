<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Laravel')</title>
    @vite('resources/css/app.css')
</head>

<body>

    @include('components.public.navbar')
    <main class="w-full min-h-screen flex justify-center items-center p-4">
        @yield('content')
    </main>
    @include('components.public.footer')


</body>

</html>
