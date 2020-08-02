require('./bootstrap');

window.Vue = require('vue');

import {BadgerAccordion, BadgerAccordionItem} from 'vue-badger-accordion'

Vue.component('BadgerAccordion', BadgerAccordion)
Vue.component('BadgerAccordionItem', BadgerAccordionItem)

Vue.component('index-page', require('./components/Index.vue').default);
Vue.component('admin-sidebar', require('./components/AdminSidebar.vue').default);
Vue.component('company-products', require('./components/CompanyDetail.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#product',
});