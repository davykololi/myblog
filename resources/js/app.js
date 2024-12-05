import './bootstrap';
import '../css/app.css';
import '@fortawesome/fontawesome-free/css/all.css';
import '@vuepic/vue-datepicker/dist/main.css';
import '@splidejs/vue-splide/css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import DataTablesLib from 'datatables.net';
import DataTablesCore from 'datatables.net';
import DataTable from 'datatables.net-vue3';
import VueDatePicker from '@vuepic/vue-datepicker';
import Particles from "@tsparticles/vue3";
import PrimeVue from 'primevue/config';
import Button from 'primevue/button';
import Column from 'primevue/column';
import Aura from '@primevue/themes/aura';
import VueSplide from '@splidejs/vue-splide';
import Vue3Lottie from 'vue3-lottie';
//Vuetify
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
//Highlight js
//import 'highlight.js/styles/stackoverflow-light.css'
//import 'highlight.js/lib/common';
//import hljsVuePlugin from "@highlightjs/vue-plugin";
//import hljs from 'highlight.js/lib/core';
//Vue-Code-Block
import { createVCodeBlock } from '@wdns/vue-code-block';
//Prism Js
import Prism from 'prismjs';
import 'prismjs/themes/prism.min.css';
import 'prismjs/components/prism-bash';
import 'prismjs/components/prism-javascript';
import 'prismjs/components/prism-json';
import 'prismjs/components/prism-liquid';
import 'prismjs/components/prism-markdown';
import 'prismjs/components/prism-markup-templating';
import 'prismjs/components/prism-php';
import 'prismjs/components/prism-scss';
import 'prismjs/components/prism-typescript';

//import { loadFull } from "tsparticles"; // if you are going to use `loadFull`, install the "tsparticles" package too.
//import { loadSlim } from "@tsparticles/slim"; // if you are going to use `loadSlim`, install the "@tsparticles/slim" package too.

DataTable.use(DataTablesLib);
DataTable.use(DataTablesCore);

const vuetify = createVuetify({
    components,directives
});

const VCodeBlock = createVCodeBlock({
    //options
});

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use( VueSplide )
            .use(Vue3Lottie)
            .use(vuetify)
            .use(Prism.highlightAll())
            .component('DataTable', DataTable)
            .component('VueDatePicker', VueDatePicker)
            .mount(el);
    },
    progress: {
        color: '#900000',
    },
});
