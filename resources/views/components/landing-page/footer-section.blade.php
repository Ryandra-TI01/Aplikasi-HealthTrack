<footer class="bg-primary text-white py-12 px-6 lg:px-20">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-6 text-sm">
        <!-- Kolom 1: Logo dan Deskripsi -->
        <div class="md:col-span-5">
            <img src="{{ asset('images/LOGO - HealthTrack 2.png') }}" alt="HealthTrack" class="h-12 mb-3 -ms-4">
            <p class="text-[12px] max-w-[320px] leading-relaxed">
                Take charge of your health journey with smart medical scheduling, custom reminders, daily health monitoring, and a supportive community. Everything you need — in one powerful app.
            </p>
        </div>

        <!-- Kolom 2: Navigation -->
        <div class="md:col-span-2">
            <h4 class="font-semibold mb-2">Navigation</h4>
            <ul class="space-y-1">
                <li><a href="#home" class="hover:underline">Home</a></li>
                <li><a href="#about" class="hover:underline">About</a></li>
                <li><a href="#features" class="hover:underline">Features</a></li>
                <li><a href="#feedbacks" class="hover:underline">Testimonials</a></li>
            </ul>
        </div>

        <!-- Kolom 3: Supports -->
        <div class="md:col-span-2">
            <h4 class="font-semibold mb-2">Supports</h4>
            <ul class="space-y-1">
                <li><a href="{{ route('feedback.index') }}" class="hover:underline">Give a Feedback</a></li>
                <li><a href="{{ route('issue.index') }}" class="hover:underline">Report an Issue</a></li>
            </ul>
        </div>

        <!-- Kolom 4: Mission -->
        <div class="md:col-span-3">
            <h4 class="font-semibold mb-2">Our Mission</h4>
            <p>Helping you stay on top of your health with simple tools and real support.</p>
        </div>
    </div>

    <div class="text-center text-xs mt-10 border-t border-white pt-6 max-w-6xl mx-auto">
        © HealthTrack {{ now()->year }}. All rights reserved.
    </div>
</footer>
