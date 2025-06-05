<div class="mb-10">
    @if(count($groups) < 5 && $centered==true)
        <div class="flex flex-wrap justify-around gap-6">
            @foreach($groups as $group)
            <livewire:components.community-group-card :group="$group" />
            @endforeach
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($groups as $group)
            <livewire:components.community-group-card :group="$group" />
            @endforeach
        </div>
    @endif
    {{-- PAGINATION --}}
    <div class="mt-8 me-16">
        {{ $groups->links() }}
    </div>

</div>
