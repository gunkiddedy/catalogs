require('./bootstrap');

window.Vue = require('vue');

Vue.component('index-page', require('./components/Index.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
// Vue.component('image-product', require('./components/ImageProduct.vue'));

const app = new Vue({
    el: '#product',
});