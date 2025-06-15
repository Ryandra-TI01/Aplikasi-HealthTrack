<div class="bg-primary/10 rounded-xl shadow-md hover:shadow-xl p-4 flex flex-col justify-between h-full
    transform-gpu will-change-transform transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 group cursor-pointer">
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
    <a href="{{ route('issue.index') }}" class="text-primary hover:text-secondary-4 text-sm mt-2 inline-block">
        <span class="link-underline">
            View Reports →
        </span>
    </a>
</div>
