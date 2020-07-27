<template>
    <div class="container-fluid bg-white" :class="{'loading': loading}">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 frontend-sidebar">
                <input type="text" class="form-control mt-3 mb-2" >
                
                <div class="category card mb-2">
                    <div class="card-body">
                        <h5 class="mt-2">Provinsi</h5>
                        <div class="form-group">
                            <select class="form-control" v-model="selected.provinsis" @change="loadKabupatens">
                                <option value="" selected>Choose...</option>
                                <option v-for="(provinsi, index) in provinsis" 
                                    :key="index" 
                                    :value="provinsi.id">
                                    {{ provinsi.name }} ({{ provinsi.products_count }})</option>
                            </select>
                            <!-- <span>Selected: {{ selected.provinsis }}</span> -->
                        </div>
                    </div>
                </div>
                <div class="category card mb-2">
                    <div class="card-body">
                        <h5 class="mt-2">Kabupaten</h5>
                        <div class="form-group">
                            <select class="form-control" v-model="selected.kabupatens">
                                <option value="" selected>Choose...</option>
                                <option v-for="(kabupaten, index) in kabupatens" :key="index" :value="kabupaten.id">
                                    {{ kabupaten.name }} ({{ kabupaten.products_count }})</option>
                            </select>
                            <!-- <span>Selected: {{ selected.kabupatens }}</span> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="category card mb-2">
                    <div class="card-body" style="max-height:250px;overflow:scroll">
                        <h5 class="mt-2">Provinsi</h5>
                        <hr>
                        <div class="custom-control custom-checkbox" v-for="(provinsi, index) in provinsis" :key="provinsi.id">
                            <input class="custom-control-input" type="checkbox" :value="provinsi.id" :id="'provinsi'+index" v-model="selected.provinsis">
                            <label class="custom-control-label" :for="'provinsi'+index">
                                {{ provinsi.name }} ({{ provinsi.products_count }})
                            </label>
                        </div>
                    </div>
                </div>
                <div class="category card mb-2">
                    <div class="card-body" style="max-height:250px;overflow:scroll">
                        <h5 class="mt-2">Kabupaten</h5>
                        <hr>
                        <div class="custom-control custom-checkbox" v-for="(kabupaten, index) in kabupatens" :key="kabupaten.id">
                            <input class="custom-control-input" type="checkbox" :value="kabupaten.id" :id="'kabupaten'+index" v-model="selected.kabupatens">
                            <label class="custom-control-label" :for="'kabupaten'+index">
                                {{ kabupaten.name }} ({{ kabupaten.products_count }})
                            </label>
                        </div>
                    </div>
                </div> -->
                <div class="category card mb-2">
                    <div class="card-body" >
                        <h5 class="mt-2">Categories</h5>
                        <hr>
                        <div class="custom-control custom-checkbox" v-for="(category, index) in category_items" :key="category.id">
                            <input class="custom-control-input" type="checkbox" :value="category.id" :id="'category'+index" v-model="selected.category_items">
                            <label class="custom-control-label" :for="'category'+index">
                                {{ category.name }} ({{ category.products_count }})
                            </label>
                        </div>
                    </div>
                </div>
                <div class="subcategory card mb-2">
                    <div class="card-body" >
                        <h5 class="mt-2">Sub Categories</h5>
                        <hr>
                        <div class="custom-control custom-checkbox" v-for="(subcategory, index) in subcategory_items" :key="subcategory.id">
                            <input 
                                class="custom-control-input" 
                                type="checkbox" 
                                :value="subcategory.id" 
                                :id="'subcategory'+index" 
                                v-model="selected.subcategory_items"
                            >
                            <label class="custom-control-label" :for="'subcategory'+index">
                                {{ subcategory.name }} ({{ subcategory.products_count }})
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 rspnv">
                <div class="row d-flex justify-content-start" id="productsfilter">
                    <div class="col-lg-3 col-md-3 col-sm-6 pt-3 col-6 rspnv-image" v-for="product in products.data" :key="product.id">
                        <div class="card text-center">
                            <div class="card-body rspnv-card-body">
                                <div class="product-info">
                                    <a :href="'product/detail/'+product.id">
                                        <img class="card-img" :src="'/storage/'+product.image_path" alt="img-product">
                                    </a>
                                    <div class="mt-2">
                                        <p class="prdct_name">{{ product.name }}</p>
                                        <hr>
                                        <h6>
                                            <a :href="'company/detail/'+product.user_id" class="prdct_company">
                                                <i class="fa fa-flag mr-1"></i>
                                                {{ product.company_name }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:2rem;">
                    <pagination :data="products" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                loading: true,
                products: {},
                category_items: [],
                subcategory_items: [],
                provinsis: [],
                kabupatens: [],
                selected: {
                    category_items: [],
                    subcategory_items: [],
                    provinsis: [],
                    kabupatens: []
                }
            }
        },

        mounted() {
            this.loadProducts();
            this.getResults();
            this.loadCategories();
            this.loadSubCategories();
            // this.loadProvinsis();
        },

        created(){
            this.loadProvinsis();
        },

        watch: {
            selected: {
                handler: function () {
                    this.loadCategories();
                    this.loadSubCategories();
                    this.loadProducts();
                    this.loadProvinsis();
                },
                deep: true
            }
        },

        methods: {
            loadProducts: function () {
                axios.get('/api/products', {
                        params: this.selected
                })
                .then((response) => {
                    this.products = response.data;
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            loadProvinsis: function(){
                axios.get('/api/getprovinsis')
                .then( (response) => {
                    this.provinsis = response.data.data;
                    // this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            loadKabupatens: function(){
                axios.get('/api/getkabupatens', {
                    params: {
                        provinsi_id: this.selected.provinsis
                    }
                })
                .then((response) => {
                    this.kabupatens = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            loadCategories: function () {
                axios.get('/api/categories', {
                    params: _.omit(this.selected, 'category_items')
                })
                .then((response) => {
                    this.category_items = response.data.data;
                    // this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            loadSubCategories: function () {
                axios.get('/api/subcategories', {
                        params: _.omit(this.selected, 'subcategory_items')
                })
                .then((response) => {
                    this.subcategory_items = response.data.data;
                    // this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getResults(page = 1) {
                axios.get('/api/products?page=' + page)
                .then((response) => {
                    this.products = response.data;
                    // this.loading = false;
                });
            }
            // searchProductsOrCompany: function(){
            //     axios.get('api/search', {
            //         params: _.omit(this.selected, 'search')
            //     })
            //     .then((response) => {
            //         this.search = response.data.data;
            //         this.loading = false;
            //     })
            //     .catch((error) => {
            //         console.log(error);
            //     });
            // },
            // loadProvinsis: function () {
            //     axios.get('/api/provinsis', {
            //             params: _.omit(this.selected, 'provinsis')
            //         })
            //         .then((response) => {
            //             this.provinsis = response.data.data;
            //             this.loading = false;
            //         })
            //         .catch(function (error) {
            //             console.log(error);
            //         });
            // },
            // loadKabupatens: function () {
            //     axios.get('/api/kabupatens', {
            //             params: _.omit(this.selected, 'kabupatens')
            //         })
            //         .then((response) => {
            //             this.kabupatens = response.data.data;
            //             this.loading = false;
            //         })
            //         .catch(function (error) {
            //             console.log(error);
            //         });
            // },
            
        }
    }

</script>