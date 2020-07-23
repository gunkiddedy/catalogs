<template>
    <div class="container-fluid bg-white" :class="{'loading': loading}">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 frontend-sidebar">
                <input class="mt-3 mb-2" type="text" name="query" 
                    id="search" 
                    placeholder="search product or company..." 
                    style="width:100%;"
                    value=""
                >
                <div class="category card mb-2">
                    <div class="card-body">
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
                    <div class="card-body">
                        <h5 class="mt-2">Kabupaten</h5>
                        <hr>
                        <div class="custom-control custom-checkbox" v-for="(kabupaten, index) in kabupatens" :key="kabupaten.id">
                            <input class="custom-control-input" type="checkbox" :value="kabupaten.id" :id="'kabupaten'+index" v-model="selected.kabupatens">
                            <label class="custom-control-label" :for="'kabupaten'+index">
                                {{ kabupaten.name }} ({{ kabupaten.products_count }})
                            </label>
                        </div>
                    </div>
                </div>
                <div class="category card mb-2">
                    <div class="card-body">
                        <h5 class="mt-2">Categories</h5>
                        <hr>
                        <div class="custom-control custom-checkbox" v-for="(category, index) in categories" :key="category.id">
                            <input class="custom-control-input" type="checkbox" :value="category.id" :id="'category'+index" v-model="selected.categories">
                            <label class="custom-control-label" :for="'category'+index">
                                {{ category.name }} ({{ category.products_count }})
                            </label>
                        </div>
                    </div>
                </div>
                <div class="subcategory card mb-2">
                    <div class="card-body">
                        <h5 class="mt-2">Sub Categories</h5>
                        <hr>
                        <div class="custom-control custom-checkbox" v-for="(subcategory, index) in subcategories" :key="subcategory.id">
                            <input 
                                class="custom-control-input" 
                                type="checkbox" 
                                :value="subcategory.id" 
                                :id="'subcategory'+index" 
                                v-model="selected.subcategories"
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
        data: function () {
            return {
                categories: [],
                subcategories: [],
                provinsis: [],
                kabupatens: [],
                products: {},
                loading: true,
                selected: {
                    categories: [],
                    subcategories: [],
                    provinsis: [],
                    kabupatens: []
                }
            }
        },

        mounted() {
            this.loadCategories();
            this.loadSubCategories();
            this.loadProvinsis();
            this.loadKabupatens();
            this.loadProducts();
            this.getResults();
            // this.loadDetails();
        },

        watch: {
            selected: {
                handler: function () {
                    this.loadCategories();
                    this.loadSubCategories();
                    this.loadProvinsis();
                    this.loadKabupatens();
                    this.loadProducts();
                    // this.loadDetails();
                },
                deep: true
            }
        },

        methods: {
            loadProvinsis: function () {
                axios.get('/api/provinsis', {
                        params: _.omit(this.selected, 'provinsis')
                    })
                    .then((response) => {
                        this.provinsis = response.data.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            loadKabupatens: function () {
                axios.get('/api/kabupatens', {
                        params: _.omit(this.selected, 'kabupatens')
                    })
                    .then((response) => {
                        this.kabupatens = response.data.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            loadCategories: function () {
                axios.get('/api/categories', {
                        params: _.omit(this.selected, 'categories')
                    })
                    .then((response) => {
                        this.categories = response.data.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            loadSubCategories: function () {
                axios.get('/api/subcategories', {
                        params: _.omit(this.selected, 'subcategories')
                    })
                    .then((response) => {
                        this.subcategories = response.data.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getResults(page = 1) {
                axios.get('/api/products?page=' + page)
                    .then(response => {
                        this.products = response.data;
                        this.loading = false;
                    });
            },
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
            }
            // loadDetails: function () {
            //     axios.get('api/details')
            //         .then(response => {
            //             this.details = response.data;
            //             this.loading = false;
            //             console.log(response.data.data[0])
            //         })
            //         .catch(function (error) {
            //             console.log(error);
            //         });
            // }

        }
    }

</script>