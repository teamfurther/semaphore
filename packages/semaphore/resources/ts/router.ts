import Vue from 'vue';
import VueRouter from 'vue-router';
import { __ } from './helpers';

import Dashboard from './views/Dashboard.vue';
import Project from './views/Project.vue';

Vue.use(VueRouter);

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
        path: '/project/:instance',
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