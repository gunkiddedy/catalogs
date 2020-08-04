<template>
    <div class="form-row">
        <div class="form-group col-md-12">
            <select class="form-control input-sm" v-model="select_provinsi" @change="loadKabupatens">
                <option :value="selected_value">All</option>
                <option 
                    v-for="(provinsi, index) in provinsis" 
                    :key="index" 
                    :value="[provinsi.id]">
                    {{ provinsi.name }}
                </option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <select class="form-control" v-model="select_kabupaten" @change="loadKecamatans">
                <option :value="selected_value">All</option>
                <option v-for="(kabupaten, index) in kabupatens" :key="index" :value="[kabupaten.id]">
                    {{ kabupaten.name }}</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <select class="form-control" v-model="select_kecamatan">
                <option :value="selected_value">All</option>
                <option 
                    v-for="(kecamatan, index) in kecamatans" 
                    :key="index" :value="[kecamatan.id]"
                >
                    {{ kecamatan.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                provinsis: [],
                kabupatens: '',
                kecamatans: '',
                select_provinsi: '',
                select_kabupaten: '',
                select_kecamatan: '',
                selected_value: []
            }
        },

        created(){
            this.loadProvinsis();
        },

        methods: {
            loadProvinsis: function(){
                axios.get('/api/getprovinsisx')
                .then( (response) => {
                    this.provinsis = response.data;
                    this.selected_value = '';
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            loadKabupatens: function(){
                axios.get('/api/getkabupatensx', {
                    params: {
                        provinsi_id: this.select_provinsi
                    }
                })
                .then((response) => {
                    this.kabupatens = response.data;
                    this.selected_value = '';
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            loadKecamatans: function(){
                axios.get('/api/getkecamatansx', {
                    params: {
                        kabupaten_id: this.select_kabupaten
                    }
                })
                .then((response) => {
                    this.kecamatans = response.data;
                    this.selected_value = '';
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            getProfilIdFromUrl: function() {
                let currentUrl = window.location.pathname;
                let arr = new Array();
                arr = currentUrl.split("/");
                let id = arr[3];
                return id;
            },
            getProvinsiId(){

            },
            getKabupatenId(){

            },
            getKecamatanId(){

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