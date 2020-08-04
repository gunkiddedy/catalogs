<template>

    <div class="row col-md-10">
        <div class="col-md-12 mb-2">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="sni" class="custom-control-input" name="sni" value="1" @change="showSNI">
                <label class="custom-control-label" for="sni">SNI</label>
            </div>
            <transition name="fade">
                <div class="form-group mt-2" v-if="show_sni">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-12">
                            <input placeholder="nomor sni" type="text" class="form-control" :required="required" name="nomor_sni" v-model="nomor_sni" @keyup="checkSNI"
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

        <div class="col-md-12 mb-2">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="tkdn" class="custom-control-input" name="tkdn" value="1" @change="showTKDN">
                <label class="custom-control-label" for="tkdn">TKDN</label>
            </div>
            <transition name="fade">

                <div class="form-group mt-2" v-if="show_tkdn">
                    <div class="row">
                        <div class="col-md-4">
                            <input placeholder="nilai_tkdn" type="text" class="form-control" :required="required" name="nilai_tkdn" v-model="nilai_tkdn" @keyup="checkNilaiTKDN">
                            <span class="badge" v-bind:class="{'badge-success': isSuccess_nil, 'text-danger': isError_nil}">
                                {{ errors_nilai_tkdn }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <input placeholder="nomor_sertifikat_tkdn" type="text" :required="required" class="form-control " name="nomor_sertifikat_tkdn" v-model="nomor_sertifikat_tkdn" @keyup="checkSertiTKDN">
                            <span class="badge" v-bind:class="{'badge-success': isSuccess_ser, 'text-danger': isError_ser}">
                                {{ errors_nomor_sertifikat_tkdn }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <input placeholder="nomor_laporan_tkdn" type="text" class="form-control " :required="required" name="nomor_laporan_tkdn" v-model="nomor_laporan_tkdn" @keyup="checkLapTKDN">
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
                required: '',
                sni: '',
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

        // computed: {
        //     // a computed getter
        //     checkSNI: function () {
        //         let regex = /(\d{6}-?:?)(\d{6}-?.?)(\d{2})$/;
        //         let nomor_sni_value = regex.test(this.nomor_sni);
        //         if(nomor_sni_value == false){
        //             this.nomor_sni = null;
        //             this.errors = 'format tidak valid';
        //         } 
        //         // return regex.test(this.nomor_sni);
        //     }
        // },

        methods: {
            checkNilaiTKDN: _.debounce(function () {
                let regex = /[+-]?([0-9]*[.])?[0-9]+/;
                let value = regex.test(this.nilai_tkdn);
                if(value == false){
                    this.nilai_tkdn = null;
                    this.isError_nil = true;
                    this.isSuccess_nil = false;
                    this.errors_nilai_tkdn = 'format tidak valid! example(0.00 atau 99.99)';
                }else{
                    this.isSuccess_nil = true;
                    this.isError_nil = false;
                    this.errors_nilai_tkdn = 'format valid';
                }
                return
                // return regex.test(this.nomor_sni);
            },2000),

            checkSertiTKDN: _.debounce(function () {
                let regex = /(\w{6}-?)(\d{6}-?.?)(\w{3}-?.?)(\d{3})$/;
                let value = regex.test(this.nomor_sertifikat_tkdn);
                if(value == false){
                    this.nomor_sertifikat_tkdn = null;
                    this.isError_ser = true;
                    this.isSuccess_ser = false;
                    this.errors_nomor_sertifikat_tkdn = 'format tidak valid! example(ASDASD-123123.asd/123)';
                }else{
                    this.isSuccess_ser = true;
                    this.isError_ser = false;
                    this.errors_nomor_sertifikat_tkdn = 'format valid';
                }
                return
                // return regex.test(this.nomor_sni);
            },2000),

            checkLapTKDN: _.debounce(function () {
                let regex = /(\w{2}\d{3}-?.?)(\w{2}\d{2})$/;
                let value = regex.test(this.nomor_laporan_tkdn);
                if(value == false){
                    this.nomor_laporan_tkdn = null;
                    this.isError_lap = true;
                    this.isSuccess_lap = false;
                    this.errors_nomor_laporan_tkdn = 'format tidak valid! example(AS123-ss28)';
                }else{
                    this.isSuccess_lap = true;
                    this.isError_lap = false;
                    this.errors_nomor_laporan_tkdn = 'format valid';
                }
                return
                // return regex.test(this.nomor_sni);
            },2000),

            checkSNI: _.debounce(function () {
                let regex = /(\d{6}-?:?)(\d{6}-?.?)(\d{2})$/;
                let value = regex.test(this.nomor_sni);
                if(value == false){
                    this.nomor_sni = null;
                    this.isError = true;
                    this.isSuccess = false;
                    this.errors = 'format tidak valid! example(123456:123133-99)';
                }else{
                    this.isSuccess = true;
                    this.isError = false;
                    this.errors = 'format valid';
                }
                return
                // return regex.test(this.nomor_sni);
            },2000),

            showSNI: function(){
                this.show_sni = !this.show_sni;
                this.required = 'required';
                // var regex = /(\d{6}-?:?)(\d{6}-?.?)(\d{2})$/;
                // console.log(regex.test('888888:899999-99'));
            },
            showTKDN: function(){
                this.show_tkdn = !this.show_tkdn;
                this.required = 'required';
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