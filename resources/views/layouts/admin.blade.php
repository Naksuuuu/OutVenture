<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Laravel')</title>
    @vite('resources/css/app.css')
</head>

<body>

    @include('components.admin.sidebar')
    @include('components.admin.navbar')
    <main class="w-full min-h-screen flex justify-center items-center p-4">
        @yield('content')
    </main>


</body>

</html>
