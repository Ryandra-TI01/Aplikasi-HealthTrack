<div>
    <!-- Greeting Section -->
    <section class="py-10 relative">
        <h2 class="text-2xl md:text-4xl font-semibold text-primary mb-2">Hi, {{ Auth::user()->name }}! Glad to see you again. 👋</h2>
        <p class="text-gray-600 max-w-2xl">Let’s keep your health on track today — check your schedules and monitor your progress.</p>
        <div class="absolute top-0 right-0 z-0">
            <img src="{{ asset('images/dots-right.png') }}" class="w-32 lg:w-48" alt="dots">
        </div>
    </section>

    <!-- Health at a Glance -->
    <h1 class="text-2xl md:text-2xl font-semibold text-primary mb-4">Your Health at a Glance</h1>
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 z-10">
        <livewire:home.health-glance.latest-health-types/>
        <livewire:home.health-glance.latest-medical-schedules/>
        <livewire:home.health-glance.latest-issue/>
    </section>

    <!-- Reminders -->
    <h1 class="text-2xl md:text-2xl font-semibold text-primary mb-4">Reminders</h1>
    <livewire:home.reminders.reminders/>

    <!-- Community Links -->
    <h1 class="text-2xl md:text-2xl font-semibold text-primary mb-4">Your Community</h1>
    <livewire:home.community-group.community-link/>

    <!-- Quick Actions -->
    <h1 class="text-2xl md:text-2xl font-semibold text-primary mb-4">Quick Actions</h1>
    <section class="mb-16 flex flex-wrap gap-4">
        <x-button class="bg-primary text-white px-4 py-2 rounded shadow">
            <a href="{{ route('health-records.create') }}">Add Health Data</a>
        </x-button>
        <x-button class="bg-primary text-white px-4 py-2 rounded shadow">
            <a href="{{ route('medical-schedule.index') }}">View Health Data</a>
        </x-button>
        <x-button class="bg-primary text-white px-4 py-2 rounded shadow">
            <a href="{{ route('health-records.index') }}">View Health Monitoring</a>
        </x-button>
        <x-button class="bg-primary text-white px-4 py-2 rounded shadow">
            <a href="{{ route('health-records.download') }}">Download Health Record</a>
        </x-button>
    </section>
</div>