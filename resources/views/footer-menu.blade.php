<!-- Footer -->
<footer class="bg-primary text-white py-6">
    <div class="max-w-6xl mx-auto px-4 text-sm flex flex-col md:flex-row justify-between items-center">
        <div class="flex flex-col items-center sm:block mb-4 md:mb-0">
            <img src="{{ asset('images/LOGO - HealthTrack 2.png') }}" class="h-12 mb-2" alt="Logo">
            <p>&copy; HealthTrack 2025. All rights reserved.</p>
        </div>
        <ul class="flex space-x-4">
            <li><a href="{{ route('dashboard') }}" class="hover:underline">Home</a></li>
            <li><a href="{{ route('medical-schedule.index') }}" class="hover:underline">Schedule</a></li>
            <li><a href="{{ route('health-records.index') }}" class="hover:underline">Health Monitoring</a></li>
            <li><a href="{{ route('community.index') }}" class="hover:underline">Community</a></li>
        </ul>
    </div>
</footer>