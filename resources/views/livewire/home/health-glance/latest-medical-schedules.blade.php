<div class="bg-primary/10 rounded-xl shadow-md hover:shadow-xl p-4 flex flex-col justify-between h-full
    transform-gpu will-change-transform transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 group cursor-pointer">
    <div>
        <h3 class="font-semibold text-lg mb-2 flex items-center text-primary">
            <img src="{{ asset('images/schedule.png') }}" alt="" class="h-8 mr-2">
            Upcoming Schedule
        </h3>
        @forelse ($schedules as $item)
            <p class="text-sm text-gray-700">
                {{ $item->title ?? 'Schedule' }} - {{ \Carbon\Carbon::parse($item->reminder_time)->calendar()  }}
            </p>
        @empty
            <p class="text-sm text-gray-700">No upcoming schedules.</p>
        @endforelse
    </div>
    <a href="{{ route('medical-schedule.index') }}" class="text-primary hover:text-secondary-4  text-sm mt-2 inline-block">
        <span class="link-underline">
           See Full Schedule →
       </span>
    </a>
</div>
