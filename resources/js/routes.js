import Vue from 'vue';
import VueRouter from 'vue-router';

import Dashboard from '../js/Components/Dashboard'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard
        }
    ]
});

export default router;