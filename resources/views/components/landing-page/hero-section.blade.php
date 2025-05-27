<section id="home" class="relative bg-white pt-20 pb-16 px-6 lg:px-20 overflow-hidden">
    <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <!-- Kiri -->
        <div class="text-center lg:text-left -top-10">
            <p class="text-gray-500 mb-2 text-xl">Welcome to HealthTrack!</p>
            <h1 class="text-3xl md:text-4xl font-bold text-primary leading-tight mb-4">
                Reliable Health Tracking <br> for Long–Term Care
            </h1>
            <p class="text-gray-600 mb-6 max-w-md mx-auto lg:mx-0">
                Manage your medications, schedule and vitals, and connect with a supportive community – all in one trusted platform built with your health in mind.
            </p>
            <x-button>
                <a href="{{ route('register') }}">Get Started</a>
            </x-button>
        </div>

        <!-- Kanan -->
        <div class="relative">
            <!-- Ilustrasi -->
            <img src="{{ asset('images/Medical prescription and treatment plan.png') }}"
                 alt="Hero Image"
                 class="max-w-xl mx-auto lg:mx-0 lg:ml-auto relative z-10">
        </div>
    </div>

    <!-- Dot pattern -->
    <div class="absolute left-0 bottom-0 z-0">
        <img src="{{ asset(path: 'images/dots-left.png') }}" alt="dots" class="w-32 lg:w-60">
    </div>
</section>
