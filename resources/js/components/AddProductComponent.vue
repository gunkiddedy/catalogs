<template>

    <div class="row">
        <div class="col-md-12">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name" >Product Name</label>
                    <input placeholder="Product name" required
                        type="text" class="form-control " name="name" value="" autofocus>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="price" >Product Description</label>
                <textarea name="description" rows="3" class="form-control" required></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="sni" class="custom-control-input" name="sni" value="1" @change="showSNI">
                    <label class="custom-control-label" for="sni">SNI</label>
                </div>
            </div>
            <transition name="fade">
                <div class="form-group" v-if="show_sni">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-12">
                            <input placeholder="nomor sni" type="text" class="form-control" :required="required" name="nomor_sni" v-model="nomor_sni" @keyup="checkSNI(nomor_sni)"
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
                    <input type="checkbox" id="tkdn" class="custom-control-input" name="tkdn" value="1" @change="showTKDN">
                    <label class="custom-control-label" for="tkdn">TKDN</label>
                </div>
            </div>
            <transition name="fade">

                <div class="form-group" v-if="show_tkdn">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-4">
                            <input placeholder="nilai tkdn" type="text" class="form-control" :required="required" name="nilai_tkdn" v-model="nilai_tkdn" @keyup="checkNilaiTKDN(nilai_tkdn)">
                            <span class="badge" v-bind:class="{'badge-success': isSuccess_nil, 'text-danger': isError_nil}">
                                {{ errors_nilai_tkdn }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <input placeholder="nomor sertifikat tkdn" type="text" :required="required" class="form-control " name="nomor_sertifikat_tkdn" v-model="nomor_sertifikat_tkdn" @keyup="checkSertiTKDN(nomor_sertifikat_tkdn)">
                            <span class="badge" v-bind:class="{'badge-success': isSuccess_ser, 'text-danger': isError_ser}">
                                {{ errors_nomor_sertifikat_tkdn }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <input placeholder="nomor laporan tkdn" type="text" class="form-control " :required="required" name="nomor_laporan_tkdn" v-model="nomor_laporan_tkdn" @keyup="checkLapTKDN(nomor_laporan_tkdn)">
                            <span class="badge ml-4" v-bind:class="{'badge-success': isSuccess_lap, 'text-danger': isError_lap}">
                                {{ errors_nomor_laporan_tkdn }}
                            </span>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <div class="col-md-12">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="hs_code" >HS Code</label>
                    <input type="text" name="hs_code" placeholder="Enter Hs Code" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="price" >Price</label>
                    <input type="text" name="price" placeholder="Enter price" required
                        class="form-control" 
                        />
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="category_id" >Category</label>
                    <select class="form-control" required name="category_id" id="category_id" v-model="select_category"
                    @change="loadSubCategory">
                        <option value="" selected="selected">Choose...</option>
                        <option 
                        v-for="(cat, i) in categories" 
                        :value="cat.id"
                        :key="i"
                        >{{cat.name}}</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="subcategory_id" >Sub Category</label>
                    <select class="form-control" name="subcategory_id" id="subcategory_id" v-model="select_subcategory">
                        <option value="" selected="selected">Choose...</option>
                        <option
                        v-for="(subc, i) in subcategories"
                        :key="i" 
                        :value="subc.id"
                        >{{subc.name}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <label for="photos">Choose images ( you can select multiple with ctrl+click image )</label>
            <div class="form-group">
                <input type="file" name="images[]" id="images" multiple>
            </div>
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
                isError_lap: true,
                categories: [],
                subcategories: [],
                select_category: '',
                select_subcategory: '',
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

        created(){
            this.loadCategory();
        },

        methods: {
            loadCategory: function(){
                axios.get('/api/getcategories')
                .then( (response) => {
                    this.categories = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            loadSubCategory: function(){
                axios.get('/api/getsubcategories', {
                    params: {
                        category_id: this.select_category
                    }
                })
                .then((response) => {
                    this.subcategories = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            checkNilaiTKDN: _.debounce(function () {
                let regex = /\d{2}(\.\d{2})?$/;

                // let regex = /[\w\.\,\/\:]+/g;
                let value = regex.test(this.nilai_tkdn);
                if(value == false){
                    this.nilai_tkdn = null;
                    this.isError_nil = true;
                    this.isSuccess_nil = false;
                    this.errors_nilai_tkdn = 'format tidak valid! example(0.00 atau 100.00)';
                }else{
                    this.isSuccess_nil = true;
                    this.isError_nil = false;
                    this.errors_nilai_tkdn = 'format valid';
                }
                return
                // return regex.test(this.nomor_sni);
            },2000),

            checkSertiTKDN: _.debounce(function (check_value) {
                // let regex = /[\w\.\,\/\:]+/g;
                // let replaceWith = /[^\w\.\/\:\,\']+/, "g";
                // let regex = /^\S[\w\.\-\/\:]+\S$/;
                let searchRegExp = /[^\w\.\/\:\,\-]+/;
                let valid = check_value.replace(searchRegExp, '');
                this.nomor_sertifikat_tkdn = valid;
                console.log(valid);
                // if(value == false){
                //     this.nomor_sertifikat_tkdn = null;
                //     this.isError_ser = true;
                //     this.isSuccess_ser = false;
                //     this.errors_nomor_sertifikat_tkdn = 'invalid! No Spaces (leading, trailing, in between)';
                // }else{
                //     this.isSuccess_ser = true;
                //     this.isError_ser = false;
                //     this.errors_nomor_sertifikat_tkdn = 'format valid';
                // }
                return
                // return regex.test(this.nomor_sni);
            },2000),

            checkLapTKDN: _.debounce(function (check_value) {
                let searchRegExp = /[^\w\.\/\:\,\-]+/;
                let valid = check_value.replace(searchRegExp, '');
                this.nomor_laporan_tkdn = valid;
                // let regex = /(\w{2}\d{3}-?.?)(\w{2}\d{2})$/;
                // let regex = /[\w\.\,\/\:]+/g;
                // let regex = /^\S[\w\.\-\/\:]+\S$/;
                // let value = regex.test(this.nomor_laporan_tkdn);
                // if(value == false){
                //     this.nomor_laporan_tkdn = null;
                //     // this.nomor_laporan_tkdn = this.nomor_laporan_tkdn.replace(/[^\w\.\/\:\,\']+/, "g", "");
                //     this.isError_lap = true;
                //     this.isSuccess_lap = false;
                //     this.errors_nomor_laporan_tkdn = 'invalid! No Spaces (leading, trailing, in between)';
                // }else{
                //     this.isSuccess_lap = true;
                //     this.isError_lap = false;
                //     this.errors_nomor_laporan_tkdn = 'format valid';
                // }
                return
                // return regex.test(this.nomor_sni);
            },2000),

            checkSNI: _.debounce(function (check_value) {
                let searchRegExp = /[^\w\.\/\:\,\-]+/;
                let valid = check_value.replace(searchRegExp, '');
                this.nomor_sni = valid;
                // let regex = /(\d{6}-?:?)(\d{6}-?.?)(\d{2})$/;
                // let regex = /[\w\.\,\/\:]+/g;
                // let regex = /^\S[\w\.\-\/\:]+\S$/;
                // let value = regex.test(this.nomor_sni);
                // if(value == false){
                //     this.nomor_sni = null;
                //     // this.nomor_sni = this.nomor_sni.replace(/[^\w\.\/\:\,\']+/, "g", "");
                //     this.isError = true;
                //     this.isSuccess = false;
                //     this.errors = 'invalid! No Spaces (leading, trailing, in between)';
                // }else{
                //     this.isSuccess = true;
                //     this.isError = false;
                //     this.errors = 'format valid';
                // }
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