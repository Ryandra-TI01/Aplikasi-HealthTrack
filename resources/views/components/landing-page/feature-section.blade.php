<div class="bg-white py-20 px-6 lg:px-20 mb-12" id="features">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-green-800 text-3xl font-bold mb-4">What You Can Do with HealthTrack?</h2>
        <p class="text-gray-600 mb-12">Empower your health journey with these key features.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ([
                ['icon' => 'schedule.png', 'title' => 'Medical Schedule Management'],
                ['icon' => 'reminder.png', 'title' => 'Custom Notification Reminders'],
                ['icon' => 'monitoring.png', 'title' => 'Daily Health Monitoring'],
                ['icon' => 'community.png', 'title' => 'Supportive Health Community'],
            ] as $feature)
                <div class="bg-green-50 rounded-lg shadow-md p-6 text-center">
                    <img src="{{ asset('images/' . $feature['icon']) }}" alt="{{ $feature['title'] }}" class="mx-auto h-12 mb-4">
                    <h3 class="text-green-700 font-semibold">{{ $feature['title'] }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</div>
