import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import JetActionSection from '@/Components/ActionSection.vue';
import JetButton from '@/Components/PrimaryButton.vue'; // or SecondaryButton.vue



const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue);
    
        // Register Jetstream components
        app.component('jet-action-section', JetActionSection);
        app.component('jet-button', JetButton);
    
        app.mount(el);
    },    
    progress: {
        color: '#4B5563',
    },
});
