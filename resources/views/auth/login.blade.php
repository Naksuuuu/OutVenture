<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" id="password" name="password" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                Login Biasa
            </button>
        </form>

        <div class="flex items-center my-4">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="flex-shrink-0 mx-4 text-gray-600 text-sm">Atau masuk dengan</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <a href="{{ route('google.login') }}"
            class="w-full flex items-center justify-center bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-2 px-4 rounded shadow-sm transition duration-300">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_13183_10121)">
                    <path
                        d="M20.3081 10.2303C20.3081 9.55056 20.253 8.86711 20.1354 8.19836H10.1704V12.3206H15.9018C15.6835 13.6919 14.9295 14.9232 13.7549 15.7231V18.5205H17.1438C19.1284 16.6533 20.3081 13.8821 20.3081 10.2303Z"
                        fill="#3F7EE8" />
                    <path
                        d="M10.1703 20.5378C12.973 20.5378 15.3621 19.5855 17.1478 17.9152L13.7589 15.1178C12.8123 15.7538 11.5859 16.1422 10.1743 16.1422C7.45269 16.1422 5.14088 14.2882 4.30138 11.7584H0.811768V14.4991C2.55167 17.9942 6.13883 20.5378 10.1703 20.5378Z"
                        fill="#34A853" />
                    <path
                        d="M4.2974 11.7585C3.85878 10.4326 3.85878 9.00994 4.2974 7.68403V4.94324H0.811797C-0.665241 7.91574 -0.665241 11.5268 0.811797 14.4993L4.2974 11.7585Z"
                        fill="#FBBC05" />
                    <path
                        d="M10.1703 4.30331C11.6661 4.28014 13.1118 4.83606 14.2007 5.86766L17.2227 2.80918C15.3087 1.00936 12.7937 0.00350929 10.1703 0.00350929C6.13883 0.00350929 2.55167 2.54714 0.811768 6.04218L4.29739 8.78297C5.13689 6.25315 7.4487 4.30331 10.1703 4.30331Z"
                        fill="#EA4335" />
                </g>
                <defs>
                    <clipPath id="clip0_13183_10121">
                        <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                    </clipPath>
                </defs>
            </svg>
            Sign in with Google
        </a>

        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">Belum punya akun? <a href="{{ route('auth.show.register') }}"
                    class="text-blue-500 hover:text-blue-700 font-bold">Daftar di sini</a></p>
        </div>
    </div>

</body>

</html>