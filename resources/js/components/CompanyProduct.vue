<template>
    <div>
        <!-- search -->
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-2">
                    <input 
                        type="search" 
                        class="form-control" 
                        placeholder="Search product name..."
                        v-model="keyword"
                        >
                    <div class="input-group-prepend">
                        <div class="input-group-text" type="button" style="cursor:pointer;" @click="searchProduct">Search</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- products company -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 rspnv">
                <div class="loading" v-if="loading"></div>
                <div class="row d-flex justify-content-start">
                    <div class="col-md-3 col-sm-6 col-6 pt-3 rspnv-image" v-for="product in products.data" :key="product.id">
                        <div class="card text-center border-white">
                            <div class="card-body rspnv-card-body">
                                <div class="product-info">
                                    <a :href="'product/detail/'+product.id">
                                        <img class="card-img" :src="'/storage/'+product.image_path" alt="img-product">
                                        <!-- {{ product.image_path }} -->
                                    </a>
                                    <div class="mt-2">
                                        <p class="prdct_name">{{ product.name }}</p>
                                        <hr>
                                        <h6>
                                            <a :href="'company/detail/'+product.user_id" class="prdct_company">
                                                <i class="fa fa-flag mr-1"></i>{{ product.company_name }}
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
                keyword: '',
                searchData: [],
                selected: {
                    searchData:{}
                }
            }
        },

        mounted() {
            this.loadProducts();
            this.getResults();
        },

        watch: {
            selected: {
                handler: function () {
                    this.loadProducts();
                },
                deep: true
            }
        },

        methods: {

            searchProduct: function() {
                let currentUrl = window.location.pathname;
                let arr = new Array();
                arr = currentUrl.split("/");
                let id = arr[3];
                let url = '/api/products/company/search/'+id;
                axios.get(url + '?keyword='+ this.keyword)
                // axios.get('/api/products/company/search/' + id + '&keyword=' + this.keyword)
                .then((response) => {
                    this.searchData = response.data;
                    this.products = this.searchData;
                    this.loading =  false;
                    console.log(id);
                })
                .catch(function (error) {
                    console.log(error);
                });  
            },

            loadProducts: function () {
                let currentUrl = window.location.pathname;
                let arr = new Array();
                arr = currentUrl.split("/");
                let id = arr[3];
                axios.get('/api/products/company/'+id, {
                        params: this.selected
                })
                // axios.get('/api/products/company/' + id)
                .then((response) => {
                    this.products = response.data;
                    console.log(response);
                    // this.loading =  false
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getResults(page = 1) {
                let currentUrl = window.location.pathname;
                let arr = new Array();
                arr = currentUrl.split("/");
                let id = arr[3];
                axios.get('/api/products/company/' +id+ '?page=' + page)
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