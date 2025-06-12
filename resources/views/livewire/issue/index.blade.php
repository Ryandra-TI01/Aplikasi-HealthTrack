<div>
    {{-- Breadcrumb navigation showing user location in the app --}}
    <livewire:components.breadcrumbs :items="[
            ['label' => 'Support', 'url' => route('support.index')],
            ['label' => 'Issues', 'url' => route('issue.index')]
        ]" 
    />

    {{-- Page header with title and description --}}
    <livewire:components.page-header 
        title="Your Report Issue" 
        description="View and track the issues you’ve reported to us. You can add new reports or check their current status anytime." 
    />

    {{-- Main section displaying issues --}}
    <livewire:issue.issue-section />

    {{-- Footer note with a thank you message to users --}}
    <livewire:components.footer-note 
        title="Every message you send helps us build a healthier, smoother HealthTrack experience for everyone."
        description="- Thank you for being part of our journey. -"
    />
</div>
