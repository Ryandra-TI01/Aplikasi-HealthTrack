<div class="bg-primary/10 rounded-xl shadow-xl p-4 flex flex-col justify-between h-full">
    <div>
        <h3 class="font-semibold mb-2 text-primary text-lg flex items-center">
            <img src="{{ asset('images/feedback-bg.png') }}" alt="" class="h-8 mr-2">
            Reports
        </h3>
        @forelse ($issues as $issue)
            <p class="text-sm text-gray-700">{{ $issue->title }}</p>
        @empty
            <p class="text-sm text-gray-700">No issues found.</p>
        @endforelse
    </div>
    <a href="#" class="text-primary hover:text-secondary-4 text-sm mt-2 inline-block">View Reports</a>
</div>
