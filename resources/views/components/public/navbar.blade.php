<nav class="w-full">
    <div class="container mx-auto flex items-center justify-between">
        <div>
            logo
        </div>
        <ul class="flex gap-4 items-center">
            <li><a href="#" class="text-gray-700 hover:text-gray-900">Home</a></li>
            <li><a href="#" class="text-gray-700 hover:text-gray-900">Categories</a></li>
            <li><a href="#" class="text-gray-700 hover:text-gray-900">Posts</a></li>
            @guest
                <li>
                    <a href="{{ route('auth.show.login') }}"
                        class="bg-blue-400 py-2 px-4 rounded-lg text-gray-700 hover:text-gray-900">
                        Login
                    </a>
                </li>
            @endguest

            @auth
                </li>
                <li>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-400 py-2 px-4 rounded-lg text-gray-700 hover:text-gray-900">
                            Logout
                        </button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</nav>
