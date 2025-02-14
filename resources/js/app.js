import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
document.addEventListener('print-donation-agreement', function () {
    window.print();
});

document.addEventListener("DOMContentLoaded", function () {
    let sidebar = document.querySelector("aside");
    let content = document.querySelector("main");
    let toggleBtn = document.getElementById("sidebarToggle");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("hidden"); // Hide/show sidebar
        content.classList.toggle("ml-0"); // Adjust content width
    });
});

