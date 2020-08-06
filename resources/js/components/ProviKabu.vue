<template>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="email">Provinsi</label>
            <select class="form-control input-sm" v-model="select_provinsi" @change="loadKabupatens">
                <option :value="value_prov" selected>All</option>
                <option v-for="(provinsi, index) in provinsis" 
                    :key="index" 
                    :value="provinsi.id"
                    >
                    {{ provinsi.name }}</option>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="inputCity">Kabupaten</label>
            <select class="form-control" v-model="select_kabupaten">
                <option :value="value_kab" selected>All</option>
                <option 
                    v-for="(kabupaten, index) in kabupatens" 
                    :key="index" 
                    :value="kabupaten.id"
                >
                {{ kabupaten.name }}
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
                kabupatens: [],
                value_prov: '',
                value_kab: '',
            }
        },

        created(){
            this.loadProvinsis();
            this.getDataUser();
        },

        // mounted(){
        //     this.getDataUser();
        // },

        methods: {

            loadProvinsis: function(){
                axios.get('/api/getprovinsis')
                .then( (response) => {
                    this.provinsis = response.data.data;
                    this.value_prov = 0;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            loadKabupatens: function(){
                axios.get('/api/getkabupatens', {
                    params: {
                        provinsi_id: this.select_provinsi
                    }
                })
                .then((response) => {
                    this.kabupatens = response.data.data;
                    this.value_kab = 0;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            getProductIdFromUrl: function() {
                let currentUrl = window.location.pathname;
                let arr = new Array();
                arr = currentUrl.split("/");
                let id = arr[3];
                return id;
            },

            getDataUser: function() {
                let user_id = this.getProductIdFromUrl();
                let url = '/api/getdatauser/' + user_id;
                axios.get(url)
                .then((response) => {
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.log(error);
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
</style>