<template>
    <div class="container-fluid bg-white">
        
        <div class="row" >
            <!-- <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white fixed-top" style="top:75px"> -->
                <div class="col-md-12 col-sm-12 col-xs-12 fixed-top show_btn_filter mb-4" style="top:85px;z-index:9999999;">
                    <button @click="showComponent" class="btn btn-light" type="button">
                        <span class="fa fa-filter" style="cursor:pointer;" ></span>
                        Filter
                    </button>
                    <!-- <p>show filter : {{isShowFilter}}</p>
                    <p>show product : {{isShowProduct}}</p>
                    <p>with : {{windowWidth}}</p> -->
                </div>
            <!-- </nav> -->
            <hr>

            <transition name="fade">
                <div class="col-lg-3 col-md-12 col-sm-12 mt-4 open-filter" v-if="isShowFilter">
                <!-- <div class="card border-white">
                    <div class="card-body"> -->
                        
                        <div class="card border-white">
                            <div class="card-body">
                                <h5 style="font-weight:bold">Search here</h5>
                                <div class="form-group d-flex justify-content-start">
                                    <input type="search" 
                                        class="form-control mr-1" 
                                        placeholder="write and enter to search"
                                        v-model="keyword"
                                        v-on:keyup.enter="searchProduct">
                                </div>
                            </div>
                        </div>
                        <div class="card border-white">
                            <div class="card-body">
                                <h5 style="font-weight:bold">Provinsi</h5>
                                <div class="form-group">
                                    <select class="form-control input-sm" v-model="selected.select_provinsi" @change="loadKabupatens">
                                        <option :value="selected_value">All</option>
                                        <option v-for="(provinsi, index) in provinsis" 
                                            :key="index" 
                                            :value="[provinsi.id]">
                                            {{ provinsi.name }} ({{ provinsi.products_count }})</option>
                                    </select>
                                    <!-- <span>Selected: {{ selected.provinsis }}</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="card border-white">
                            <div class="card-body">
                                <h5 style="font-weight:bold">Kabupaten</h5>
                                <div class="form-group">
                                    <select class="form-control" v-model="selected.select_kabupaten">
                                        <option :value="selected_value">All</option>
                                        <option v-for="(kabupaten, index) in kabupatens" :key="index" :value="[kabupaten.id]">
                                            {{ kabupaten.name }} ({{ kabupaten.products_count }})</option>
                                    </select>
                                    <!-- <span>Selected: {{ selected.kabupatens }}</span> -->
                                </div>
                            </div>
                            <!-- <p>show filter : {{isShowFilter}}</p>
                            <p>show product : {{isShowProduct}}</p> -->
                        </div>
                        <div class="card border-white">
                            <div class="card-body" >
                                <h5 style="font-weight:bold">Categories</h5>
                                <hr>
                                <div class="custom-control custom-checkbox" v-for="(category, index) in category_items" :key="category.id">
                                    <input class="custom-control-input" type="checkbox" :value="category.id" :id="'category'+index" v-model="selected.category_items">
                                    <label class="custom-control-label" :for="'category'+index">
                                        {{ category.name }} ({{ category.products_count }})
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card border-white">
                            <div class="card-body" >
                                <h5 style="font-weight:bold">Sub Categories</h5>
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
                    <!-- </div>
                </div> -->
                    <button @click="showComponent" class="btn btn-primary" type="button" style="width:100%">
                        <span class="fa fa-filter" style="cursor:pointer;" ></span>
                        Terapkan
                    </button>
                </div>
            </transition>
            
            <transition name="fade">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 rspnv" v-if="isShowProduct">
                    <!-- <p>width : {{ windowWidth }} - height {{ windowHeight}}</p> -->
                    <!-- <p>show product : {{isShowProduct}}</p> -->
                    <div class="loading" v-if="loading"></div>
                    <div class="row d-flex justify-content-start" id="productsfilter">
                        <div class="col-lg-3 col-md-3 col-sm-6 pt-3 col-6 rspnv-image" v-for="product in products.data" :key="product.id">
                            <div class="card text-center border-white">
                                <div class="card-body rspnv-card-body">
                                    <div class="product-info">
                                        <a :href="'product/detail/'+product.id">
                                            <img class="card-img" :src="'/storage/'+product.image_path" alt="img-product">
                                        </a>
                                        <div class="">
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
            </transition>
            
        </div>
    </div>
</template>

<script defer>
    export default {
        data: function() {
            return {
                isShowProduct: true,
                isShowFilter: true,
                windowWidth: 0,
                // windowHeight: 0,
                // isHide: true,
                loading: true,
                products: {},
                category_items: [],
                subcategory_items: [],
                provinsis: [],
                kabupatens: [],
                select_provinsi: [],
                select_kabupaten: [],
                selected_value: [],
                searchData: [],
                keyword: '',
                selected: {
                    searchData: {},
                    category_items: [],
                    subcategory_items: [],
                    select_provinsi: [],
                    select_kabupaten: []
                }
            }
        },

        mounted() {
            this.loadProducts();
            this.getResults();
            this.loadCategories();
            this.loadSubCategories();
            this.getWindowWidth();
            // this.loadProvinsis();
            //this.$nextTick(function() {
                //window.addEventListener('resize', this.getWindowWidth);
                // window.addEventListener('resize', this.getWindowHeight);

                //Init
                //this.getWindowWidth();
                // this.getWindowHeight()
            //});
            //this.showProducts(); //true show products
        },

        created(){
            this.loadProvinsis();
        },

        // computed: {
        //     showProducts() {
        //         this.isShowProduct = !this.isShowProduct;
        //     }
        // },

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

        // beforeDestroy() {
        //     window.removeEventListener('resize', this.getWindowWidth);
        //     window.removeEventListener('resize', this.getWindowHeight);
        // },

        methods: {
            showComponent: function () {
                this.isShowFilter = !this.isShowFilter; //toggle this filter (false) true
                if(this.isShowFilter == true){
                    this.isShowProduct = false;
                }
                if(this.isShowFilter == false){
                    this.isShowProduct = true;
                }
            },

            // showProducts(){
            //     this.isShowProduct = true;
            // },

            getWindowWidth() {
                this.windowWidth = document.documentElement.clientWidth;
                if(this.windowWidth <= 991){
                    this.isShowFilter = false; //hide filter when window is <= 991
                }else{
                    this.isShowFilter = true; //show filter when window > 991
                }
            },

            // getWindowHeight(event) {
            //     this.windowHeight = document.documentElement.clientHeight;
            // },

            searchProduct: function() {
                axios.get('/api/products/search', {
                    params: {
                        keyword: this.keyword
                    }
                })
                .then((response) => {
                    this.searchData = response.data;
                    this.products = this.searchData;
                    this.loading =  false
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });  
            },

            loadProducts: function () {
                axios.get('/api/products', {
                        params: this.selected
                })
                .then((response) => {
                    this.products = response.data;
                    this.loading =  false
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            loadProvinsis: function(){
                axios.get('/api/getprovinsis')
                .then( (response) => {
                    this.provinsis = response.data.data;
                    // this.select_provinsi = [];
                    // this.select_kabupaten = [];
                    this.selected_value = [];
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            loadKabupatens: function(){
                axios.get('/api/getkabupatens', {
                    params: {
                        provinsi_id: this.selected.select_provinsi
                    }
                })
                .then((response) => {
                    this.kabupatens = response.data.data;
                    // this.select_kabupaten = [];
                    this.selected_value = [];
                    this.loading =  false;
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
                    this.loading = false;
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
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getResults(page = 1) {
                axios.get('/api/products?page=' + page)
                .then((response) => {
                    this.products = response.data;
                    this.loading = false;
                });
            }            
        }
    }

</script>

<style scoped>

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}

/* .fade-leave-active below version 2.1.8 */ 
.fade-enter, .fade-leave-to {
  opacity: 0;
}

.loading {
    position: fixed;
    z-index: 1000;
    height: 2em;
    width: 2em;
    overflow: visible;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
  }

  /* Transparent Overlay */
  .loading:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255,255,255);
    /* background-color: rgba(0,0,0,0.3); */
  }

  /* :not(:required) hides these rules from IE9 and below */
  .loading:not(:required) {
    /* hide "loading..." text */
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
  }

  .loading:not(:required):after {
    content: '';
    display: block;
    font-size: 10px;
    width: 1em;
    height: 1em;
    margin-top: -0.5em;
    -webkit-animation: spinner 1500ms infinite linear;
    -moz-animation: spinner 1500ms infinite linear;
    -ms-animation: spinner 1500ms infinite linear;
    -o-animation: spinner 1500ms infinite linear;
    animation: spinner 1500ms infinite linear;
    border-radius: 0.5em;
    -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
    box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  }

  /* Animation */

  @-webkit-keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  @-moz-keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  @-o-keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  @keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
</style>