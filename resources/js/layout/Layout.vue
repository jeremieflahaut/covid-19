<template>
    <v-app id="app">

        <!-- NAVIGATION -->
        <left-menu></left-menu>

        <!-- APP BAR -->
        <app-bar></app-bar>


        <!-- CONTENT -->
        <v-main>
            <router-view></router-view>
        </v-main>

        <!-- FOOTER -->
        <footer-layout></footer-layout>
        

    </v-app>
</template>

<script>

export default {
    name: 'Layout',

    data () {
        return {
            
        }
    },
    mounted() {
        this.$bus.getDepartments()
        this.$bus.fetchData()
    },
    components: {
        FooterLayout: () => import(/* webpackChunkName: "layout" */ './Footer'),
        AppBar: () => import(/* webpackChunkName: "layout" */ './AppBar'),
        LeftMenu: () => import(/* webpackChunkName: "layout" */ './LeftMenu'),
    }
}
</script>
<style scoped>

</style>
