<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <h1>Selamat Datang, {{ Auth::user()->nama_lengkap }}!</h1>

        <hr>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background-color: red; color: white;">Logout</button>
        </form>
    </div>
</body>

</html>
