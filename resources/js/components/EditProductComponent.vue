<template>

    <div>
        <div class="col-md-12">
            
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input 
                        type="checkbox"
                        id="sni"
                        class="custom-control-input"
                        name="sni"
                        :checked="checkedSNI"
                        @change="showSNI"
                        :value="sni"
                    >
                    <!-- <p>{{ nomor_sni }}</p> -->
                    <label class="custom-control-label" for="sni">SNI</label>
                </div>
            </div>

            <transition name="fade">
                <div class="form-group" v-if="show_sni">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-12">
                            <input 
                                placeholder="nomor sni"
                                type="text"
                                class="form-control"
                                :required="required"
                                name="nomor_sni"
                                v-model="nomor_sni"
                                @keyup="checkSNI(nomor_sni)"
                            >
                            <span class="badge" v-bind:class="{'badge-success': isSuccess, 'text-danger': isError}">
                                {{ errors }}
                            </span>
                            <!-- <p style="display:none">{{ checkSNI }}</p> -->
                        </div>
                    </div>
                </div>
            </transition>

        </div>

        <div class="col-md-12">

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input 
                        type="checkbox"
                        id="tkdn"
                        class="custom-control-input"
                        name="tkdn"
                        :checked="checkedTKDN"
                        :value="tkdn"
                        @change="showTKDN"
                    >
                    <label class="custom-control-label" for="tkdn">TKDN</label>
                </div>
            </div>

            <transition name="fade">
                <div class="form-group" v-if="show_tkdn">
                    <div class="row d-flex justify-content-between">

                        <div class="col-md-4">
                            <input 
                                placeholder="nilai tkdn"
                                type="text"
                                class="form-control"
                                :required="required"
                                name="nilai_tkdn"
                                v-model="nilai_tkdn"
                                @keyup="checkNilaiTKDN(nilai_tkdn)"
                            >
                            <span class="badge" v-bind:class="{'badge-success': isSuccess_nil, 'text-danger': isError_nil}">
                                {{ errors_nilai_tkdn }}
                            </span>
                        </div>

                        <div class="col-md-4">
                            <input 
                                placeholder="nomor sertifikat tkdn"
                                type="text"
                                :required="required"
                                class="form-control"
                                name="nomor_sertifikat_tkdn"
                                v-model="nomor_sertifikat_tkdn"
                                @keyup="checkSertiTKDN(nomor_sertifikat_tkdn)"
                            >
                            <span class="badge" v-bind:class="{'badge-success': isSuccess_ser, 'text-danger': isError_ser}">
                                {{ errors_nomor_sertifikat_tkdn }}
                            </span>
                        </div>

                        <div class="col-md-4">
                            <input 
                                placeholder="nomor laporan tkdn"
                                type="text"
                                class="form-control"
                                :required="required"
                                name="nomor_laporan_tkdn"
                                v-model="nomor_laporan_tkdn"
                                @keyup="checkLapTKDN(nomor_laporan_tkdn)"
                            >
                            <span class="badge ml-4" v-bind:class="{'badge-success': isSuccess_lap, 'text-danger': isError_lap}">
                                {{ errors_nomor_laporan_tkdn }}
                            </span>
                        </div>

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
                show_sni: false,
                show_tkdn: false,
                isRequiredSNI: false,
                isRequiredTKDN: false,
                nomor_sni: '',
                nilai_tkdn: '',
                nomor_sertifikat_tkdn: '',
                nomor_laporan_tkdn: '',
                required: 'required',
                checkedSNI: '',
                checkedTKDN: '',
                sni: '',
                tkdn: '',
                errors: '',
                errors_nilai_tkdn: '',
                errors_nomor_sertifikat_tkdn: '',
                errors_nomor_laporan_tkdn: '',
                isSuccess: false,
                isError: true,
                isSuccess_nil: false,
                isError_nil: true,
                isSuccess_ser: false,
                isError_ser: true,
                isSuccess_lap: false,
                isError_lap: true
            }
        },

        mounted(){
            this.getDataProduct();
        },

        methods: {

            getProductIdFromUrl: function() {
                let currentUrl = window.location.pathname;
                let arr = new Array();
                arr = currentUrl.split("/");
                let id = arr[3];
                return id;
            },

            getDataProduct: function() {
                let product_id = this.getProductIdFromUrl();
                let url = '/api/getdata/' + product_id;
                axios.get(url)
                .then((response) => {
                    this.sni = response.data.sni;
                    this.tkdn = response.data.tkdn;

                    if(response.data.sni == 1){
                        this.show_sni = true;
                        this.checkedSNI = 'checked';
                        this.nomor_sni = response.data.nomor_sni;
                    }
                    if(response.data.tkdn == 1){
                        this.show_tkdn = true;
                        this.checkedTKDN = 'checked';
                        this.nilai_tkdn = response.data.nilai_tkdn;
                        this.nomor_sertifikat_tkdn = response.data.nomor_sertifikat_tkdn;
                        this.nomor_laporan_tkdn = response.data.nomor_laporan_tkdn;
                    }
                    console.log(response.data.sni);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            checkNilaiTKDN: _.debounce(function () {
                let regex = /\d{2}(\.\d{2})?$/;
                let value = regex.test(this.nilai_tkdn);
                if(value == false){
                    this.nilai_tkdn = null;
                    this.isError_nil = true;
                    this.isSuccess_nil = false;
                    this.errors_nilai_tkdn = 'invalid! example(99.50)';
                }else{
                    this.isSuccess_nil = true;
                    this.isError_nil = false;
                    this.errors_nilai_tkdn = 'format valid';
                }
                return
            },2000),

            checkSertiTKDN: _.debounce(function (check_value) {
                let searchRegExp = /[^\w\.\/\:\,\-]+/;
                let valid = check_value.replace(searchRegExp, '');
                this.nomor_sertifikat_tkdn = valid;
                return
            },2000),

            checkLapTKDN: _.debounce(function (check_value) {
                let searchRegExp = /[^\w\.\/\:\,\-]+/;
                let valid = check_value.replace(searchRegExp, '');
                this.nomor_laporan_tkdn = valid;
                return
            },2000),

            checkSNI: _.debounce(function (check_value) {
                let searchRegExp = /[^\w\.\/\:\,\-]+/;
                let valid = check_value.replace(searchRegExp, '');
                this.nomor_sni = valid;
                return
            },2000),

            showSNI: function(){
                this.show_sni = !this.show_sni;
                this.required = !this.required;
            },

            showTKDN: function(){
                this.show_tkdn = !this.show_tkdn;
                this.required = !this.required;
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