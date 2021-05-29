import config from './Config';
import axios from 'axios';
import { createApp, h } from 'vue';
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from '@inertiajs/inertia-vue3';

import { diffForHumans, simple, expanded } from './Plugins/moment';
import { InertiaProgress } from '@inertiajs/progress';
import Chart from 'vue-frappe-chart';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = document.getElementById('app');

createApp({
    metaInfo: {
        titleTemplate: (title) =>
            title ? `${title} - ${config('app.name')}` : config('app.name'),
    },

    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: (name) => require(`./Views/${name}`).default,
        }),
})
    .mixin({
        methods: {
            route,
            config,
            diffForHumans,
            simple,
            expanded
        }
    })
    .use(InertiaPlugin)
    .use(Chart)
    .mount(app);

InertiaProgress.init({
    delay: 250,
    color: '#10B981',
    includeCSS: true,
    showSpinner: false,
});
