/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('group-view', require('./components/GroupComponent.vue').default);
Vue.component('team-view', require('./components/TeamComponent.vue').default);
import GroupComponent from './components/GroupComponent.vue';
import TeamComponent from './components/TeamComponent.vue';

const routes = [
    {path:'/', component:GroupComponent, name:'index'},
    {path:'/group/:id', component:TeamComponent, name:'teams'}
];

const router = new VueRouter({base: '/team', mode: 'history', routes });


const app = new Vue({
    el: '#app',
    router
});
