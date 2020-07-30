require('./bootstrap');

window.Vue = require('vue');

import CompanyDetail from './components/CompanyDetail.vue';

Vue.component('company-products', CompanyDetail);

Vue.component('index-page', require('./components/Index.vue').default);
// Vue.component('company-products', require('./components/CompanyProduct.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));
// Vue.component('image-product', require('./components/ImageProduct.vue'));

const app = new Vue({
    el: '#product',
});