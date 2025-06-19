<header x-data="{ open: false }" class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-6xl mx-auto px-4 lg:px-20 py-2 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/LOGO - HealthTrack 1.png') }}" alt="Logo" class="h-12 w-auto object-contain">
            </a>
        </div>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center space-x-6 text-sm text-gray-700">
            <a href="#home" class="hover:text-green-700 link-underline">Home</a>
            <a href="#about" class="hover:text-green-700 link-underline">About</a>
            <a href="#features" class="hover:text-green-700 link-underline">Features</a>
            <a href="#feedbacks" class="hover:text-green-700 link-underline">Testimonials</a>
            <x-button>
                @if (Auth::check())
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endif
            </x-button>
        </nav>

        <!-- Hamburger Button -->
        <div class="md:hidden">
            <button @click="open = !open" class="text-gray-700 focus:outline-none">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div x-show="open" x-transition class="md:hidden px-4 pb-4">
        <div class="flex flex-col space-y-2 text-sm text-gray-700">
            <a href="#home" class="hover:text-green-700">Home</a>
            <a href="#about" class="hover:text-green-700">About</a>
            <a href="#features" class="hover:text-green-700">Features</a>
            <a href="#feedbacks" class="hover:text-green-700">Testimonials</a>
            <x-button class="w-fit">
                @if (Auth::check())
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endif
            </x-button>
        </div>
    </div>
</header>

<!-- Spacer -->
<div class="h-20"></div>