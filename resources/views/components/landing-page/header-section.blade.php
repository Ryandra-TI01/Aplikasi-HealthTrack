<header class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-6xl mx-auto px-4 lg:px-20 py-2 flex items-center justify-between">
        <div class="flex items-center space-x-2 overflow-hidden">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/LOGO - HealthTrack 1.png') }}" alt="Logo" class="h-12 w-auto object-contain">
            </a>
        </div>

        <nav class="hidden md:flex items-center space-x-6 text-sm text-gray-700">
            <a href="#home" class="hover:text-green-700 link-underline">Home</a>
            <a href="#about" class="hover:text-green-700 link-underline">About</a>
            <a href="#features" class="hover:text-green-700 link-underline">Features</a>
            <a href="#feedbacks" class="hover:text-green-700 link-underline">Testimonials</a>
            <x-button >
                @if (Auth::check())
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endif
            </x-button>
        </nav>
    </div>
</header>

<div class="h-12"></div>
