<header class="bg-white shadow p-4 flex justify-between items-center w-full sticky top-0 z-[9997]">
    <div class="flex items-center gap-4">
        <button @click="mobileMenuOpen = !mobileMenuOpen"
            class="md:hidden hover:cursor-pointer text-gray-600 hover:text-gray-800 focus:outline-none">
            <x-lucide-text-align-justify class="w-6 h-6" />
        </button>

        <button @click="isCollapsed = !isCollapsed"
            class="hidden md:block hover:cursor-pointer text-gray-600 hover:text-gray-800 focus:outline-none">
            <x-lucide-text-align-justify class="w-6 h-6" />
        </button>

        <h2 class="text-sm font-medium text-gray-500 hidden sm:block">Dashboard</h2>
    </div>

    <div class="flex items-center gap-4 text-gray-600">
        <div class="flex items-center gap-2">
            <span class="text-sm font-semibold text-gray-700">{{ auth()->user()->nama_lengkap ?? 'Admin' }}</span>

        </div>
    </div>
</header>
