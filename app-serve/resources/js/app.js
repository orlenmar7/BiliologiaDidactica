
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

require('./tinymce_import.js');

import { HasError, AlertError, AlertSuccess } from 'vform';
import './interceptors';

[
	HasError,
  	AlertError,
  	AlertSuccess
].forEach(Component => {
  Vue.component(Component.name, Component)
});

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/es';

Vue.use(ElementUI, { locale, size: 'medium' });

import Editor from '@tinymce/tinymce-vue';
Vue.component('tinymce', Editor);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('histories-create', require('./components/histories/create.vue').default);
Vue.component('categories-create', require('./components/categories/create.vue').default);
Vue.component('contact-form', require('./components/contact-form').default);
Vue.component('create-tests', require('./components/create-tests').default);
Vue.component('create-memories', require('./components/create-memories').default);
Vue.component('create-letter-soups', require('./components/create-letter-soups').default);
Vue.component('pay-test', require('./components/test').default);
Vue.component('pay-letter-soup', require('./components/letter_soup').default);
Vue.component('pay-puzzles', require('./components/puzzles').default);
Vue.component('pay-memories', require('./components/memories').default);
Vue.component('avatars', require('./components/avatars').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
