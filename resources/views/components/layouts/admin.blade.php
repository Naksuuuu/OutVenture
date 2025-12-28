<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ $title ?? 'Admin - Outventure' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100" x-data="{
    mobileMenuOpen: false,
    isCollapsed: @json(session('sidebar_collapsed', false)),
    showNotification: false,
    notificationType: 'success',
    notificationMessage: ''
}"
    @notify.window="
        showNotification = true; 
        notificationType = $event.detail.type; 
        notificationMessage = $event.detail.message; 
        setTimeout(() => showNotification = false, 3000)
    ">

    <livewire:admin.template.sidebar />

    <div x-show="mobileMenuOpen" x-transition.opacity @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-black/50 z-[9998] md:hidden">
    </div>

    <div :class="isCollapsed ? 'md:ml-20' : 'md:ml-64'" class="transition-all duration-300 min-h-screen">

        <livewire:admin.template.navbar />

        <main class="p-4">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts

    {{-- Trigger notify dari session redirect --}}
    @if (session('notifySuccess'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: {
                        type: 'success',
                        message: '{{ session('notifySuccess') }}'
                    }
                }));
            });
        </script>
    @endif

    @if (session('notifyError'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: {
                        type: 'error',
                        message: '{{ session('notifyError') }}'
                    }
                }));
            });
        </script>
    @endif

    {{-- Modal Pop-up Notifikasi Success/Error --}}
    <div x-show="showNotification" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
        style="display: none;">

        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm"></div>

        <!-- Modal Content -->
        <div
            class="relative z-[10000] w-full max-w-sm bg-white rounded-2xl shadow-2xl border border-slate-100 p-8 space-y-4">
            <div class="flex items-center justify-center mb-4">
                <div x-show="notificationType === 'success'"
                    class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div x-show="notificationType === 'error'"
                    class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
            </div>

            <div class="text-center">
                <h3 class="text-xl font-bold mb-2"
                    :class="notificationType === 'success' ? 'text-green-600' : 'text-red-600'">
                    <span x-text="notificationType === 'success' ? 'Berhasil!' : 'Gagal!'"></span>
                </h3>
                <p class="text-slate-600 text-sm" x-text="notificationMessage"></p>
            </div>

            <div class="flex items-center justify-center pt-4">
                <button @click="showNotification = false"
                    class="text-xs font-bold text-slate-500 uppercase tracking-widest hover:text-slate-700 transition-colors px-6 py-2 rounded-lg hover:bg-slate-50">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</body>

</html>
