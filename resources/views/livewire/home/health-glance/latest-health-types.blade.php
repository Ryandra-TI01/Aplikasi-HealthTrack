<div class="bg-primary/10 rounded-xl shadow-md hover:shadow-xl p-4 flex flex-col justify-between h-full
    transform-gpu will-change-transform transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 group cursor-pointer">
    <div>
        <h3 class="font-semibold mb-3 text-primary text-lg flex items-center">
            <img src="{{ asset('images/monitoring.png') }}" alt="" class="h-8 mr-2">
            Latest Health Data
        </h3>
        @foreach ($data as $item)
            <p class="text-sm text-gray-700">{{ $item['name'] }}: {{ $item['value'] }} {{ $item['unit'] }}</p>
        @endforeach
    </div>

    <a href="{{ route('health-records.index') }}"
       class="text-primary group-hover:text-secondary-4 transition-colors duration-300 text-sm mt-3 inline-block">
       <span class="link-underline">
           Go to Monitoring →
       </span>
    </a>
</div>
