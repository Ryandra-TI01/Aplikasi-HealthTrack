<div>
    {{-- Breadcrumb navigation showing user location in the app --}}
    <livewire:components.breadcrumbs :items="[
            ['label' => 'Support', 'url' => route('support.index')],
            ['label' => 'Feedback', 'url' => route('feedback.index')]
        ]" 
    />

    {{-- Page header with title and description --}}
    <livewire:components.page-header 
        title="Your Feedback" 
        description="View and manage the feedback you’ve submitted to help us improve your HealthTrack experience." 
    />

    {{-- Main section displaying user feedback or empty state --}}
    <livewire:feedback.feedback-section />

    {{-- Footer note with a thank you message to users --}}
    <livewire:components.footer-note 
        title="Every message you send helps us build a healthier, smoother HealthTrack experience for everyone."
        description="- Thank you for being part of our journey. -"
    />
</div>
