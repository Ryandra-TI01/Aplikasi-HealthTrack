<div 
    x-data="{
        show: false,
        message: '',
        type: 'info',
        timeout: null,

        notify(type, message) {
            this.type = type;
            this.message = message;
            this.show = true;
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => {
                this.show = false;
            }, 5000);
        },

        toastClasses() {
            switch(this.type) {
                case 'success':
                    return 'bg-green-300';
                case 'error':
                    return 'bg-red-300';
                case 'info':
                default:
                    return 'bg-blue-300';
            }
        },

        toastIcon() {
            switch(this.type) {
                case 'success':
                    return '✅'; // Centang
                case 'error':
                    return '❌'; // Silang
                case 'info':
                default:
                    return 'ℹ️'; // Info
            }
        }
    }"
    x-on:notify.window="notify($event.detail.type, $event.detail.message)"
    class="mb-3"
>
    <div 
        x-show="show"
        x-transition
        :class="toastClasses()"
        class="flex items-center gap-3 text-white px-4 py-3 rounded-lg shadow-lg min-w-[250px]"
    >
        <span x-text="toastIcon()" class="text-2xl"></span>
        <div class="flex-1" x-text="message"></div>
        <button @click="show = false" class="text-white text-xl leading-none">&times;</button>
    </div>
</div>