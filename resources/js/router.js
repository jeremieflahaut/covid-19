import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.APP_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import(/* webpackChunkName: "home" */ './views/Home.vue')
        },
        {
            path: '/tests',
            name: 'tests',
            component: () => import(/* webpackChunkName: "tests" */ './views/Tests.vue')
        }
    ]
});