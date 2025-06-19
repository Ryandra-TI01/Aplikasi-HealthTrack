<section id="about" class="bg-white py-16 relative overflow-hidden">
    <div class="mx-auto flex flex-col lg:flex-row items-center justify-between">
        
        <!-- Illustration -->
        <div
            class="w-full lg:w-1/2 mb-10 lg:mb-0 relative opacity-0 translate-y-10 transition-all duration-700"
            data-aos="fade-right"
            data-aos-delay="200"
        >
            <img 
                src="{{ asset('images/Stethoscope with checklist.png') }}"
                alt="About Illustration"
                class="w-full max-w-lg mx-auto lg:mx-0 transition-transform duration-500 hover:scale-105"
            >
        </div>

        <!-- Text Content -->
        <div
            class="w-full lg:w-1/2 mt-10 lg:mt-0 lg:pr-12 opacity-0 translate-y-10 transition-all duration-700 delay-200 px-4"
            x-data
            x-intersect.once="$el.classList.remove('opacity-0', 'translate-y-10')"
        >
            <h5 class="text-gray-500 text-sm mb-2">About HealthTrack</h5>
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                Empowering Your<br class="hidden md:inline">Health Journey
            </h2>
            <p class="text-gray-600 leading-relaxed text-justify my-6 md:my-4">
                HealthTrack is a digital health companion designed to help you take control of your medical routines.
                From scheduling checkups and receiving timely reminders, to logging daily health stats and connecting
                with supportive communities — HealthTrack is here to simplify and support every step of your wellness journey.
            </p>
        </div>


    </div>

    <!-- Parallax Dot Ornament -->
    <div
        class="absolute top-4 right-4 md:top-6 md:right-10 lg:top-8 lg:right-16 z-0"
        data-aos="fade-left"
        data-aos-delay="200"
        x-data="{ scrollY: 0 }"
        x-init="window.addEventListener('scroll', () => scrollY = window.scrollY)"
        :style="'transform: translateY(' + (scrollY * 0.05) + 'px)'"
    >
        <img src="{{ asset('images/dots-right.png') }}" alt="dots" class="w-24 md:w-32 lg:w-48">
    </div>
</section>
