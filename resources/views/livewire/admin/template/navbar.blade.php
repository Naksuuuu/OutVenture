<header class="bg-white shadow p-4 flex justify-between items-center w-full">

    <button @click="$dispatch('toggle-sidebar')"
        class="hover:cursor-pointer text-gray-600 hover:text-gray-800 focus:outline-none">
        <x-lucide-text-align-justify />
    </button>

    <div class="text-gray-600">
        <!-- Navbar content here -->
    </div>
</header>
