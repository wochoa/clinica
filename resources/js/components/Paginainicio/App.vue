<template>
<div>
    <Cabecera :urlini="urlini" :logeado="logeado" :usuario="usuario"/>
    <transition name="slide-fade" mode="out-in">
        <div class="content-wrapper">
            <router-view :urlini="urlini"> </router-view>
        </div>
    </transition>
    <Footer />
</div>
</template>

<script>
import Cabecera from './Header.vue'
import Footer from './Footer.vue'
export default {
    name: 'ClinicaApp',
    props: ['urlini','logeado','usuario'],
    components: {
        Cabecera,
        Footer
    },

    data() {
        return {

        };
    },

    mounted() {

    },

    methods: {

    },
};
</script>

<style lang="scss" scoped>

</style>
