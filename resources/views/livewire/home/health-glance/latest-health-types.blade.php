<div class="bg-primary/10 rounded-xl shadow-xl p-4 flex flex-col justify-between h-full">
    <div>
        <h3 class="font-semibold mb-2 text-primary text-lg flex items-center">
            <img src="{{ asset('images/monitoring.png') }}" alt="" class="h-8 mr-2">
            Latest Health Data
        </h3>
        @foreach ($data as $item)
            <p class="text-sm text-gray-700">{{ $item['name'] }}: {{ $item['value'] }} {{ $item['unit'] }}</p>
        @endforeach
    </div>
    <a href="{{ route('health-records.index') }}" class="text-primary hover:text-secondary-4 text-sm mt-2 inline-block">Go to Monitoring</a>
</div>
