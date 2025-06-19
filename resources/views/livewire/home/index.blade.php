<div>
    <!-- Greeting Section -->
    <section class="py-10 px-4 md:px-0 relative overflow-hidden">
        <div class="max-w-6xl mx-auto relative z-10">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-primary mb-3">
                Hi, {{ Auth::user()->name }}! Glad to see you again. 👋
            </h2>
            <p class="text-gray-600 text-base sm:text-lg max-w-2xl">
                Let’s keep your health on track today — check your schedules and monitor your progress.
            </p>
        </div>

        <!-- Dots Ornament (Top-Right) -->
        <div class="absolute top-2 right-2 md:top-4 md:right-8 lg:top-6 lg:right-12 z-0 opacity-50 pointer-events-none">
            <img src="{{ asset('images/dots-right.png') }}" class="w-24 sm:w-32 lg:w-48" alt="dots">
        </div>
    </section>


    <!-- Health at a Glance -->
    <h1 class="text-2xl md:text-2xl font-semibold text-primary mb-4 mx-4 sm:mx-0">Your Health at a Glance</h1>
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 z-10 p-4 sm:p-0">
        <livewire:home.health-glance.latest-health-types/>
        <livewire:home.health-glance.latest-medical-schedules/>
        <livewire:home.health-glance.latest-issue/>
    </section>

    <!-- Reminders -->
    <h1 class="text-2xl md:text-2xl font-semibold text-primary mb-4 mx-4 sm:mx-0">Reminders</h1>
    <livewire:home.reminders.reminders/>

    <!-- Community Links -->
    <h1 class="text-2xl md:text-2xl font-semibold text-primary mb-4 mx-4 sm:mx-0">Your Community</h1>
    <livewire:components.community-card/>

    <!-- Quick Actions -->
    <h1 class="text-2xl md:text-2xl font-semibold text-primary mb-4 mx-4 sm:mx-0">Quick Actions</h1>
    <section class="mb-16 flex flex-wrap gap-4 p-4 sm:p-0">
        <x-button class="bg-primary text-white px-4 py-2 rounded shadow">
            <a href="{{ route('medical-schedule.index') }}">View Schedule</a>
        </x-button>
        <x-button class="bg-primary text-white px-4 py-2 rounded shadow">
            <a href="{{ route('health-records.index') }}">View Health Monitoring</a>
        </x-button>
        <x-button class="bg-primary text-white px-4 py-2 rounded shadow">
            <a href="{{ route('health-records.download') }}">Download Health Record</a>
        </x-button>
    </section>
</div>