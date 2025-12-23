<header class="bg-white shadow p-4 flex justify-between items-center w-full">

    <button @click="$dispatch('toggle-sidebar')" class="text-gray-600 hover:text-gray-800 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
    </button>

    <div class="text-gray-600">
        <!-- Navbar content here -->
    </div>
</header>
