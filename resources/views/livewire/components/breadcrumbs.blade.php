<nav class="text-sm text-gray-500 mb-6">
    <ol class="list-reset flex items-center space-x-2">
        <li>
            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:underline flex items-center">
                <img src="{{ asset('images/home.png') }}" class="h-4 mr-2" alt="home">
                Home
            </a>
        </li>
        @foreach($items as $index => $item)
            <li>
                <span class="mx-1">/</span>
            </li>
            <li>
                @if($index === count($items) - 1)
                    <span class="text-primary font-semibold">{{ $item['label'] }}</span>
                @else
                    <a href="{{ $item['url'] }}" class="text-primary hover:underline">{{ $item['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
