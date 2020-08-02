require('./bootstrap');

window.Vue = require('vue');

// import CompanyDetail from './components/CompanyDetail.vue';

// import the component
import Treeselect from '@riophae/vue-treeselect'
// import the styles
import '@riophae/vue-treeselect/dist/vue-treeselect.css'

Vue.component('treeselect', Treeselect);

Vue.component('index-page', require('./components/Index.vue').default);
Vue.component('admin-sidebar', require('./components/AdminSidebar.vue').default);
Vue.component('company-products', require('./components/CompanyDetail.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#product',
});