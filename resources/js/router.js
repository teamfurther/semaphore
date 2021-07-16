import VueRouter from 'vue-router';
import { __ } from './helpers';

import Dashboard from './views/Dashboard.vue';
import Project from './views/Project.vue';

const routes = [
    {
        name: 'dashboard',
        path: '/',
        component: Dashboard,
        meta: {
            title: __('Dashboard')
        }
    },
    {
        name: 'project',
        path: '/project/:slug',
        component: Project,
        meta: {
            title: __('Project')
        }
    }
];

export default new VueRouter({
    base: process.env.BASE_URL,
    routes: routes
});