<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    @include('components.admin.sidebar')

    <div class="ml-64">
        @include('components.admin.navbar')

        <main class="min-h-screen">
            @yield('content')
        </main>
    </div>

</body>
</html>
