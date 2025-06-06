<div>
    <livewire:components.breadcrumbs :items="[
            ['label' => 'Community', 'url' => route('community.index')]
        ]" 
    />

    <livewire:components.page-header 
        title="Join a Supportive Health Community" 
        description="Join our supportive communities to share stories, ask questions, and grow stronger together."
    />

    <livewire:components.community-card centered="true"/>
    
    <livewire:components.footer-note 
        title="Every connection you make brings us closer as a community."
        description="– Your presence in the community makes a difference. –"
    />
</div>
