<nav class="bg-white border-b border-gray-200 shadow-md fixed w-full top-0 z-50" x-data="{ open: false }">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('welcome') }}">
                    <img class="h-12 w-auto" src="{{ asset('images/LOGO - HealthTrack 1.png') }}" alt="HealthTrack Logo">
                </a>
            </div>

            <!-- Desktop Nav -->
            <div class="hidden lg:flex space-x-10 ml-10">
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 hover:text-primary link-underline">Home</a>
                <a href="{{ route('medical-schedule.index') }}" class="text-sm text-gray-700 hover:text-primary link-underline">Schedule</a>
                <a href="{{ route('health-records.index') }}" class="text-sm text-gray-700 hover:text-primary link-underline">Health Monitoring</a>
                <a href="{{ route('community.index') }}" class="text-sm text-gray-700 hover:text-primary link-underline">Community</a>
            </div>

            <!-- Right side desktop -->
            <div class="hidden lg:flex items-center space-x-4">
                <!-- Feedback Icon -->
                <a href="{{ route('support.index') }}" class="text-gray-500 hover:text-primary link-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 15q.425 0 .713-.288T13 14t-.288-.712T12 13t-.712.288T11 14t.288.713T12 15m-1-4h2V5h-2zM2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm3.15-6H20V4H4v13.125zM4 16V4z"/>
                    </svg>
                </a>

                <!-- Profile -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="inline-flex items-center px-3 py-2 border text-sm rounded-md text-gray-700 hover:text-primary">
                                    {{ Auth::user()->name }}
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div>
                            <x-dropdown-link href="{{ route('profile.show') }}">Profile</x-dropdown-link>

                            @php
                                $isAdmin = auth()->check() && auth()->user()->hasRole('admin');
                            @endphp
                            @if ($isAdmin)
                                <x-dropdown-link href="{{ route('filament.admin.pages.dashboard') }}">
                                    {{ __('Dashboard Admin') }}
                                </x-dropdown-link>
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">API Tokens</x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger (Mobile Only) -->
            <div class="lg:hidden">
                <button @click="open = !open" class="text-gray-600 hover:text-primary focus:outline-none">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open" x-transition class="lg:hidden mt-2 space-y-2 pb-4">
            <a href="{{ route('dashboard') }}" class="block text-sm text-gray-700 hover:text-primary">Home</a>
            <a href="{{ route('medical-schedule.index') }}" class="block text-sm text-gray-700 hover:text-primary">Schedule</a>
            <a href="{{ route('health-records.index') }}" class="block text-sm text-gray-700 hover:text-primary">Health Monitoring</a>
            <a href="{{ route('community.index') }}" class="block text-sm text-gray-700 hover:text-primary">Community</a>
            <a href="{{ route('support.index') }}" class="block text-sm text-gray-700 hover:text-primary">Feedback</a>

            <!-- Profile Photo Dropdown di Mobile -->
            <div class="pt-4 border-t border-gray-200">
                <div class="flex items-center space-x-3 px-4">
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    <div class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</div>
                </div>
                <div class="mt-2 space-y-1 px-4">
                    <a href="{{ route('profile.show') }}" class="block text-sm text-gray-600 hover:text-primary">Profile</a>
                    @if ($isAdmin)
                        <a href="{{ route('filament.admin.pages.dashboard') }}" class="block text-sm text-gray-600 hover:text-primary">Dashboard Admin</a>
                    @endif
                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <a href="{{ route('api-tokens.index') }}" class="block text-sm text-gray-600 hover:text-primary">API Tokens</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="mt-2" x-data>
                        @csrf
                        <button type="submit" class="block w-full text-left text-sm text-gray-600 hover:text-primary">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
