<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('storage/favicon/tes3.svg') }}">
    <title>{{ $title ?? 'Outventure - Perlengkapan Outdoor Terbaik' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @stack('styles-css')
</head>

<body x-data="{
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

    <livewire:public.template.navbar />

    <main class="w-full min-h-screen pt-16 md:pt-[100px]">
        {{ $slot }}
    </main>

    <livewire:public.template.footer />

    @livewireScripts

    @stack('scripts')
    @stack('body-js')

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

    <div x-show="showNotification" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        :class="notificationType === 'success' ? 'bg-green-50 text-green-700 border-green-200' :
            'bg-red-50 text-red-700 border-red-200'"
        class="fixed bottom-10 right-10 p-4 border rounded-md shadow-lg max-w-sm z-50" style="display: none;">
        <span x-text="notificationMessage"></span>
    </div>

</body>

</html>
