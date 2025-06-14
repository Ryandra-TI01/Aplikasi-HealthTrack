<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" type="image/png" href="{{ asset('images/Logo-HealthTrack-circle.png') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-white">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main >
                <div class="pt-28 pb-8">
                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-12">
                        {{ $slot }}
                    </div>
                </div>
            </main>
            
            {{-- @livewire('footer-menu') --}}
            @include('footer-menu')
        </div>

        @stack('modals')
        {{-- @livewire('components.alert') --}}
        <livewire:components.alert/>

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>

        <script>
            window.addEventListener('scrollToTop', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        </script>

        <script src="https://www.gstatic.com/firebasejs/10.12.0/firebase-app-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging-compat.js"></script>

        <script>
            const firebaseConfig = {
                apiKey: "AIzaSyCdgV6kwhRJFWaux8YBjjeaqPNoisA9KjQ",
                authDomain: "healthtrackapp-be4ec.firebaseapp.com",
                projectId: "healthtrackapp-be4ec",
                storageBucket: "healthtrackapp-be4ec.firebasestorage.app",
                messagingSenderId: "104168353896",
                appId: "1:104168353896:web:ad5d07b284252b7b1e8bdd",
                measurementId: "G-7WZR1J8S5Y"
            };

            firebase.initializeApp(firebaseConfig);

            const messaging = firebase.messaging();
        </script>

        <script>
            // VAPID key dari Firebase console (Cloud Messaging tab)
            const VAPID_KEY = "BJ3M_vfDyD3oBGq5_tBB5hfKfms8mmGv2E6A754aSFZV0ay7ANaVfkM2CeLCL1s8ZrrBgjYlGfM2-4E8uslD1qY";

            // Hanya jalankan jika user login
            @auth
            // Minta izin notifikasi
            Notification.requestPermission().then((permission) => {
                if (permission === 'granted') {
                    messaging.getToken({ vapidKey: VAPID_KEY }).then((token) => {
                        if (token) {
                            // Kirim token ke backend
                            fetch('/fcm-token', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                credentials: 'include',
                                body: JSON.stringify({ token })
                            }).then(res => res.json()).then(data => {
                                console.log('Token berhasil dikirim:', data);
                            });
                        }
                    }).catch((err) => {
                        console.error('Gagal ambil token:', err);
                    });
                } else {
                    console.log('Izin notifikasi ditolak');
                }
            });

            // Tampilkan notifikasi jika ada pesan saat tab aktif
            messaging.onMessage((payload) => {
                console.log('Foreground Message:', payload);
                new Notification(payload.notification.title, {
                    body: payload.notification.body,
                    icon: 'https://github.com/Ryandra-TI01/Aplikasi-HealthTrack/blob/main/public/images/Logo-HealthTrack-circle.png?raw=true' // Optional: icon notifikasi
                });
            });
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/firebase-messaging-sw.js')
                    .then(function (registration) {
                    console.log('Service Worker registered:', registration);
                    messaging.useServiceWorker(registration);
                    });
                }

            @endauth
        </script>

    </body>
</html>
