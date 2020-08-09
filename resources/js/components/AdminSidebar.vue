<template>
    <div class="card">
        <div class="card-header">
            <a href="#" class="link text-primary" @click="showSidebar">
                <i class="fa fa-bars"></i> MENUS</a> 
        </div>
        <transition name="fade">
            <ul class="list-group" v-if="show_sidebar">
                <a href="/members" class="list-group-item member-navigation">
                    <i class="fa fa-group"></i> Users</a>
                <a href="/product-require" class="list-group-item member-navigation">
                    <i class="fa fa-handshake-o"></i> Product Approval</a>
                <a href="/category" class="list-group-item member-navigation">
                    <i class="fa fa-bookmark"></i> Category</a>
                <a href="/provinsi" class="list-group-item member-navigation">
                    <i class="fa fa-location-arrow"></i> Provinsi</a>
                <a href="/kabupaten" class="list-group-item member-navigation">
                    <i class="fa fa-location-arrow"></i> Kabupaten</a>
                <a href="/kecamatan" class="list-group-item member-navigation">
                    <i class="fa fa-location-arrow"></i> Kecamatan</a>
                <a href="/blacklist" class="list-group-item member-navigation">
                    <i class="fa fa-gavel"></i> Black List
                </a>
                <!-- <a href="/about" class="list-group-item member-navigation">About</a>
                <a href="/contact" class="list-group-item member-navigation">Contact</a> -->
            </ul>
        </transition>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                show_sidebar: true
            }
        },
        methods: {
            showSidebar: function(){
                this.show_sidebar = !this.show_sidebar;
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