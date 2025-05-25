<section id="about" class="bg-white py-16 relative overflow-hidden">
    <div class=" mx-auto flex flex-col lg:flex-row items-center justify-between">
        {{-- Ilustrasi Stetoskop --}}
        <div class="w-full lg:w-1/2 mb-10 lg:mb-0 relative">
                <img 
        src="{{ asset('images/Stethoscope with checklist.png') }}"
        alt="About Illustration"
        class="w-full max-w-lg mx-auto lg:mx-0"
    >
        </div>

        {{-- Text Konten --}}
        <div class="w-full lg:w-1/2 lg:pl-12 text-center mx-8 lg:mr-48 ">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                Empowering Your<br>Health Journey
            </h2>
            <p class="text-gray-600 leading-relaxed text-justify mx-24 my-12 lg:mx-0 lg:my-4">
                HealthTrack is a digital health companion designed to help you take control of your medical routines.
                From scheduling checkups and receiving timely reminders, to logging daily health stats and connecting
                with supportive communities — HealthTrack is here to simplify and support every step of your wellness journey.
            </p>
        </div>
    </div>
    <!-- Dot kanan atas -->
    <div class="absolute top-6 right-6 lg:top-8 lg:right-16 z-0">
        <img src="{{ asset('images/dots-right.png') }}" alt="dots" class="w-32 lg:w-48">
    </div>
</section>
