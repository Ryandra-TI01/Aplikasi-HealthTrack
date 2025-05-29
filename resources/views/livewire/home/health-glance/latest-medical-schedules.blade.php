<div class="bg-primary/10 rounded-xl shadow-xl p-4 flex flex-col justify-between h-full ">
    <div>
        <h3 class="font-semibold text-lg mb-2 flex items-center text-primary">
            <img src="{{ asset('images/schedule.png') }}" alt="" class="h-8 mr-2">
            Upcoming Schedule
        </h3>
        @forelse ($schedules as $item)
            <p class="text-sm text-gray-700">
                {{ $item->title ?? 'Schedule' }} - {{ $item->reminder_time }}
            </p>
        @empty
            <p class="text-sm text-gray-700">No upcoming schedules.</p>
        @endforelse
    </div>
    <a href="{{ route('medical-schedule.index') }}" class="text-primary hover:text-secondary-4  text-sm mt-2 inline-block">See Full Schedule</a>
</div>
