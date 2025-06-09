<div>
    <livewire:components.breadcrumbs :items="[
            ['label' => 'Support', 'url' => route('support.index')]
        ]" 
    />
    <livewire:components.page-header 
        title="How Can We Help Improve HealthTrack?" 
        description="Were always working to improve your experience. Let us know how we’re doing or if something is not working quite right." 
    />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-md md:max-w-2xl mx-auto mb-24">
        <livewire:support.support-card 
            title="Tell Us What You Think!" 
            description="Help us enhance your experience." 
            icon="images/feedback-people.png" 
            bgColor="bg-primary/20"
            textColorTitle="text-secondary-2"
            textColorDescription="text-black"
            buttonVariant="primary"
            buttonLink="{{ route('feedback.index') }}"
            buttonText="Send Feedback"
        />
    
        <livewire:support.support-card 
            title="Found Something Wrong?" 
            description="Help us fix what’s broken." 
            icon="images/warning.png" 
            bgColor="bg-error/20"
            textColorTitle="text-error"
            textColorDescription="text-black"
            buttonVariant="error"
            buttonLink="#"
            buttonText="Report an Issue"
        />
    </div>

    <livewire:components.footer-note 
        title="Every message you send helps us build a healthier, smoother HealthTrack experience  for everyone."
        description="- Thank you for being part of our journey. -"
    />

</div>

