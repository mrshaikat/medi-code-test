require('./bootstrap');
require('./sb-admin');
window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import { routes } from './routes/routes';

const router = new VueRouter({
    routes,
    mode:'history'
  })


Vue.component('create-product', require('./components/CreateProduct.vue').default);

const app = new Vue({
    el: '#app',
    router
});
