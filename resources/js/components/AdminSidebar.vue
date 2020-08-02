<template>
    <div class="card">
        <div class="card-header">
            <a href="#" class="link text-primary" @click="showSidebar">NAVIGATION</a> 
        </div>
        <ul class="list-group" v-if="show_sidebar">
            <a href="/members" class="list-group-item member-navigation">Users</a>
            <a href="/category" class="list-group-item member-navigation">Category</a>
            <a href="/provinsi" class="list-group-item member-navigation">Provinsi</a>
            <a href="/kabupaten" class="list-group-item member-navigation">Kabupaten</a>
            <a href="/kecamatan" class="list-group-item member-navigation">Kecamatan</a>
            <a href="/about" class="list-group-item member-navigation">About</a>
            <a href="/contact" class="list-group-item member-navigation">Contact</a>
        </ul>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                show_sidebar: false
            }
        },
        methods: {
            showSidebar: function(){
                this.show_sidebar = !this.show_sidebar;
            }
        }
    }

</script>