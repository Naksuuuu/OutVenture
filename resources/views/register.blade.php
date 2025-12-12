<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/style.css">
    <title>Halaman Register</title>
</head>

<body>
    <form action="/register" method="POST">
        @csrf
        @if ($errors->any())
            <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label for="name">Nama Lengkap:</label>
            <input type="text" id="name" name="nama_lengkap" required>
        </div>

        <div>
            <label for="notelp">No Telp:</label>
            <input type="tel" id="notelp" name="no_tlp" required>
        </div>

        <div>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Konfirmasi Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">Register</button>
    </form>
</body>

</html>
