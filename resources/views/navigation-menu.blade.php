<nav class="bg-white border-b border-gray-200 shadow-xl fixed w-full top-0 z-50">
    <div class="max-w-6xl mx-auto pr-4 sm:px-6 ">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}">
                    <img class="h-12 w-auto" src="{{ asset('images/LOGO - HealthTrack 1.png') }}" alt="HealthTrack Logo">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden lg:flex space-x-10 ml-10">
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 hover:text-primary">Home</a>
                <a href="{{ route('medical-schedule.index') }}" class="text-sm text-gray-700 hover:text-primary">Schedule</a>
                <a href="{{ route('health-records.index') }}" class="text-sm text-gray-700 hover:text-primary">Health Monitoring</a>
                <a href="#" class="text-sm text-gray-700 hover:text-primary">Community</a>
            </div>

            <!-- Right section (Feedback icon + Dropdowns) -->
            <div class="flex items-center space-x-4">
                <!-- Feedback Icon -->
                <a href="#" class="text-gray-700 hover:text-primary">
                    <img src="{{ asset('images/feedback.png') }}" alt="">
                </a>

                <!-- Team Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="hidden sm:flex sm:items-center sm:ml-2">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 hover:text-primary">
                                    {{ Auth::user()->currentTeam->name }}
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 15L12 18.75 15.75 15M8.25 9L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400">Manage Team</div>
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>
                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200 my-2"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400">Switch Teams</div>
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Profile Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
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
        </div>
    </div>
</nav>
