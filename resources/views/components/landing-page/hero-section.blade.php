<section
    id="home"
    class="relative bg-white pt-20 pb-16 px-6 lg:px-20 overflow-hidden vh"
    x-data="{ scrollY: 0 }"
    x-init="
        window.addEventListener('scroll', () => {
            scrollY = window.scrollY;
        })
    "
>
    <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <!-- Kiri -->
        <div class="text-center lg:text-left -top-10" data-aos="fade-right">
            <p class="text-gray-500 mb-2 text-xl" data-aos="fade-right" data-aos-delay="100">
                Welcome to HealthTrack!
            </p>
            <h1 class="text-3xl md:text-4xl font-bold text-primary leading-tight mb-4" data-aos="fade-right" data-aos-delay="200">
                Reliable Health Tracking <br> for Long–Term Care
            </h1>
            <p class="text-gray-600 mb-6 max-w-md mx-auto lg:mx-0" data-aos="fade-right" data-aos-delay="300">
                Manage your medications, schedule and vitals, and connect with a supportive community – all in one trusted platform built with your health in mind.
            </p>
            <x-button>
                <a href="{{ route('register') }}">Get Started</a>
            </x-button>

        </div>

        <!-- Kanan -->
        <div class="relative" data-aos="fade-left">
            <img
                src="{{ asset('images/Medical prescription and treatment plan.png') }}"
                alt="Hero Image"
                class="max-w-xl mx-auto lg:mx-0 lg:ml-auto relative z-10 transition-transform duration-500 hover:scale-105"
            />
        </div>
    </div>

    <!-- Dot pattern -->
    <div class="absolute left-0 bottom-0 z-0"
        :style="'transform: translateY(' + (scrollY * 0.1) + 'px)'">
        <img src="{{ asset('images/dots-left.png') }}" alt="dots" class="w-32 lg:w-60">
    </div>

</section>
