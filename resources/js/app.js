import './bootstrap';
import '../css/app.css';
import '@vuepic/vue-datepicker/dist/main.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import DataTablesLib from 'datatables.net';
import DataTablesCore from 'datatables.net';
import DataTable from 'datatables.net-vue3';
import VueDatePicker from '@vuepic/vue-datepicker';
import Editor from '@tinymce/tinymce-vue';
import Particles from "@tsparticles/vue3";
import PrimeVue from 'primevue/config';
import Button from 'primevue/button';
import Aura from '@primevue/themes/aura';
//import { loadFull } from "tsparticles"; // if you are going to use `loadFull`, install the "tsparticles" package too.
//import { loadSlim } from "@tsparticles/slim"; // if you are going to use `loadSlim`, install the "@tsparticles/slim" package too.

 
DataTable.use(DataTablesLib);
DataTable.use(DataTablesCore);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue,{
                theme:{
                    preset: Aura,
                }
            })
            .use(ZiggyVue)
            .component('DataTable', DataTable)
            .component('VueDatePicker', VueDatePicker)
            .component('editor', Editor)
            .component('Button', Button)
            .mount(el);
    },
    progress: {
        color: '#900000',
    },
});
