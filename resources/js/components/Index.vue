<template>
    <div class="container-fluid bg-white">
        
        <div class="row">

            <!-- BUTTON FILTER ON MOBILE VIEW -->
            <div class="col-md-12 col-sm-12 col-xs-12 fixed-top show_btn_filter mb-4" 
                style="top:85px; z-index:9999999;">
                <button style="cursor:pointer;" @click="showFilter" class="btn btn-primary">
                    <span class="fa fa-filter"></span> Filter
                </button>
            </div>

            <br>

            <transition name="fade">
                <div class="col-lg-3 col-md-12 col-sm-12 mt-4 open-filter" v-if="isShowFilter">

                    <!-- SEARCH  -->
                    <div class="card border-white">
                        <div class="card-body">
                            <h5 style="font-weight:bold">Search</h5>
                            <div class="input-group mb-2">
                                <input 
                                    type="search" 
                                    class="form-control" 
                                    placeholder="product or company"
                                    v-model="keyword"
                                    v-on:keyup.enter="searchProduct"
                                    >
                                <div class="input-group-prepend">
                                    <div class="input-group-text" type="button" style="cursor:pointer;" @click="searchProduct">
                                    Search
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PROVINSI -->
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
                            </div>
                        </div>
                    </div>

                    <!-- KABUPATEN -->
                    <div class="card border-white">
                        <div class="card-body">
                            <h5 style="font-weight:bold">Kabupaten</h5>
                            <div class="form-group">
                                <select class="form-control" v-model="selected.select_kabupaten">
                                    <option :value="selected_value">All</option>
                                    <option v-for="(kabupaten, index) in kabupatens" :key="index" :value="[kabupaten.id]">
                                        {{ kabupaten.name }} ({{ kabupaten.products_count }})</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- CATEGORY FILTER-->
                    <div class="card border-white">
                        <div class="card-body bg-white">
                            <h5 style="font-weight:bold">Find by Category</h5>
                            <div id="accordion">
                                <div class="card border-white" v-for="(cat, index) in DataSource" :key="index">

                                    <!-- CATEGORY -->
                                    <div class="card-header bg-white border-white" style="padding:0.25rem">
                                        <span @click="getCategory(cat.id)" style="cursor:pointer;color:gray" >
                                            {{ cat.label }}
                                        </span>
                                        <i @click="$set(closedItems, index, !closedItems[index])" class="fa fa-angle-down float-right" style="cursor:pointer">
                                        </i>
                                    </div>

                                    <!-- SHOW SUBCATEGORY -->
                                    <transition name="fade">
                                        <div v-if="closedItems[index]" class="show_subcat">
                                            <div 
                                                class="card-body bg-white" 
                                                v-for="(child, indexs) in cat.children" 
                                                :key="indexs" 
                                                style="padding:0.25rem;margin-left: 2.5rem !important;"
                                            >
                                                <span @click="getSubCategory(child.id)" style="cursor:pointer;color:deepskyblue">
                                                    {{ child.label }} 
                                                </span>
                                            </div>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- BUTTON TERAPKAN -->
                    <button @click="showFilter" class="btn btn-primary show_btn_filter" style="width:100%">
                        <span class="fa fa-filter" style="cursor:pointer;" ></span>
                        Terapkan
                    </button>
                </div>
            </transition>
            
            <!-- PRODUCTS -->
            <transition name="fade">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 rspnv" v-if="isShowProduct">
                    <div class="loading" v-if="loading"></div>
                    <div class="row d-flex justify-content-start" id="productsfilter">
                        <!-- <div class="col-lg-3 col-md-3 col-sm-6 pt-3 col-6 rspnv-image" v-for="product in products.data" :key="product.id">
                            <div class="card text-center">
                                <div class="card-body rspnv-card-body">
                                    <div class="product-info">
                                        <a :href="'product/detail/'+product.id">
                                            <img class="card-img img-hover" :src="'/storage/'+product.image_path" alt="img-product">
                                        </a>
                                    </div>
                                </div>
                                <div class="card-footer" style="background-color:rgba(243, 242, 244, 0.42) !important">
                                    <p class="prdct_name">{{ product.name }}</p>
                                    <h6>
                                        <a :href="'company/detail/'+product.user_id" class="prdct_company">
                                            <i class="fa fa-flag mr-1"></i>
                                            {{ product.company_name }}
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-3 col-md-3 col-sm-6 pt-3 col-6 rspnv-image" v-for="product in products.data" :key="product.id">
                            <div class="grid">
                                <div class="item">
                                    <a :href="'product/detail/'+product.id" :aria-labelledby="product.id"></a>
                                    <img class="card-img" :src="'/storage/'+product.image_path" alt="img-product">
                                    <div class="item__overlay">
                                        <div class="front-title">
                                            <span style="font-weight:bold;" :id="product.id" aria-hidden="true">{{ product.name }}</span>
                                            <span style="color:gray;font-size:14px;">{{ product.company_name }}</span>
                                        </div>
                                        <div class="item__body">
                                            <span style="font-size:13px;color:gray;">Jakarta Barat</span><br>
                                            <i class="fa fa-globe"></i> 
                                            <span v-if="product.sni" class="badge badge-primary">
                                                <i class="fa fa-check"></i> trusted suplier
                                            </span>
                                            <span v-else class="badge badge-warning text-white">
                                                <i class="fa fa-close"></i> not trusted suplier
                                            </span>
                                        </div>
                                        <button class="btn btn-primary mb-2 ml-3 mr-3">Visit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- SHOW PAGINATION -->
                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:2rem;">
                        <pagination :data="products" @pagination-change-page="getResults"></pagination>
                    </div>

                </div>
            </transition>
            
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                DataSource: [],
                closedItems: [],
                loading: true,
                isShowProduct: true,
                isShowFilter: true,
                windowWidth: 0,
                products: {},
                provinsis: [],
                kabupatens: [],
                select_provinsi: [],
                select_kabupaten: [],
                selected_value: [],
                searchData: [],
                keyword: '',
                subcat: '',
                selected: {
                    searchData: {},
                    select_provinsi: [],
                    select_kabupaten: []
                }
            }
        },

        mounted() {
            this.loadProducts();
            this.getResults();
            this.getWindowWidth();
            this.apiCategories();
            // this.getAccordion();
            //this.$nextTick(function() {
                //window.addEventListener('resize', this.getWindowWidth);
                // window.addEventListener('resize', this.getWindowHeight);

                //Init
                //this.getWindowWidth();
                // this.getWindowHeight()
            //});
        },

        created(){
            this.loadProvinsis();
        },

        watch: {
            selected: {
                handler: function () {
                    this.loadProducts();
                    this.loadProvinsis();
                },
                deep: true
            }
        },

        methods: {
            
            getCategory: function(id){
                axios.get('/api/products/category/' + id)
                .then((response) => {
                    this.searchData = response.data;
                    this.products = this.searchData;
                    this.loading =  false
                })
                .catch((err) => {
                    console.log(err);
                });
            },

            getSubCategory: function(id){
                axios.get('/api/products/subcategory/' + id)
                .then((response) => {
                    this.searchData = response.data;
                    this.products = this.searchData;
                    this.loading =  false
                })
                .catch((err) => {
                    console.log(err);
                });
            },

            apiCategories: function() {
                axios.get('/api/mapingcategories')
                .then((response) => {
                    this.DataSource = response.data;
                    this.loading =  false
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            showFilter: function () {
                this.isShowFilter = !this.isShowFilter; //toggle this filter (false) true

                if(this.isShowFilter == true){
                    this.isShowProduct = false;
                }

                if(this.isShowFilter == false){
                    this.isShowProduct = true;
                }
            },

            getWindowWidth() {
                this.windowWidth = document.documentElement.clientWidth;

                if(this.windowWidth <= 991){
                    this.isShowFilter = false; //hide filter when window is <= 991
                }else{
                    this.isShowFilter = true; //show filter when window > 991
                }
            },

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
                    // console.log(response.data);
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
                    this.loading = false;
                    this.selected_value = [];
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
                    this.loading =  false;
                    this.selected_value = [];
                })
                .catch((error) => {
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

            // loadCategories: function () {
            //     axios.get('/api/categories', {
            //         params: _.omit(this.selected, 'category_items')
            //     })
            //     .then((response) => {
            //         this.category_items = response.data.data;
            //         this.loading = false;
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     });
            // },

            // loadSubCategories: function () {
            //     axios.get('/api/subcategories', {
            //             params: _.omit(this.selected, 'subcategory_items')
            //     })
            //     .then((response) => {
            //         this.subcategory_items = response.data.data;
            //         this.loading = false;
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     });
            // },

        }
    }

</script>

<style scoped>

/* IMAGE SLIDE-UP */
* {
	 box-sizing: border-box;
}
 .grid {
	 display: grid;
	 grid-template-columns: repeat(auto-fit, 15rem);
	 gap: 2rem;
}
 .item {
	 position: relative;
	 height: 21rem;
	 background-color: lightGrey;
	 overflow-y: hidden;
     box-shadow: 0.1rem 0.1rem 1rem rgba(0, 0, 0, 0.1);
}
.front-title {
	 margin: 0;
	 display: block;
     background-color:#fff;
     padding: 0.3rem 0 0 1rem;
     display: grid;
}
 .item a {
	 position: absolute;
	 top: 0;
	 left: 0;
	 width: 100%;
	 height: 100%;
	 z-index: 1;
}
 .item a:hover ~ .item__overlay, .item a:focus ~ .item__overlay {
	 transform: translate3d(0, 0, 0);
}
 img {
	 width: 100%;
	 height: 100%;
	 display: block;
     object-fit: cover;
}
 .item__overlay {
	 display: flex;
	 flex-direction: column;
	 justify-content: center;
	 height: 100%;
	 position: absolute;
	 width: 100%;
	 top: 0;
	 transition: transform 300ms;
	 background-color: #fff;
     transform: translate3d(0, calc(100% - 3.5rem), 0);
}
 .item__body {
	 flex-grow: 1;
	 padding: 1rem;
}
 .item__body p {
	 margin: 0;
}
 
/* END IMAGE SLIDE-UP */

.show_subcat{
    transition: 0.2s ease-in-out;
}

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