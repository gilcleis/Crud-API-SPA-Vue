require('./bootstrap');

import Vue from 'vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueSweetalert2 from "vue-sweetalert2"
Vue.use(VueSweetalert2)

import routes from './routes'

import App from './components/App.vue'

import moment from 'moment';

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY hh:mm')
    }
});


Vue.component('pagination', require('laravel-vue-pagination'))

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes)
});











/*
require('./bootstrap');

window.Vue = require('vue').default;
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
*/
