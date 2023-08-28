<template>
<div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark navbar-white" style="background: linear-gradient(29deg, rgb(11, 185, 183) 27%, rgb(3, 122, 214) 100%);">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img :src="urlini+'/../dist/img/logo SD-.png'" alt="AdminLTE Logo" height="60">

            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                    <li class="nav-item">
                        <a href="/" class="nav-link">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">CONTACTANOS</a>
                    </li>
                    <li class="nav-item" v-if="modooscuro==false">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button" @click="cambiomodooscuro"><i class="fa-regular fa-moon fa-1x"></i></a>
                    </li>
                    <li class="nav-item" v-else>
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button" @click="cambiomodoclaro"><i class="fa-solid fa-moon"></i></a>
                    </li>
                    <li class="nav-item" v-if="logeado">
                        <!-- <el-badge :value="'cuenta'" class="item" type="success"> -->
                            <a href="/home" class="nav-link"><i class="fa-solid fa-right-to-bracket"></i> {{ usuario.name }} </a>
                        <!-- </el-badge> -->

                    </li>
                    <li class="nav-item" v-else><a href="/login" class="nav-link">INGRESAR</a></li>

                    <!-- @if (Route::has('login'))

                @auth
                <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Home</a></li>
                @else
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">INGRESAR</a></li>

                    @if (Route::has('register'))
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">REGISTRASE</a></li>
                    @endif
                @endauth

        @endif -->

                </ul>

            </div>

        </div>
    </nav>
    <!-- /.navbar -->
</div>
</template>

<script>
export default {
    name: 'Header',
    props: ['urlini', 'logeado', 'usuario'],
    data() {
        return {
            modooscuro: false

        };
    },

    mounted() {

    },

    methods: {
        cambiomodooscuro() {
            this.modooscuro = true;
            document.body.classList.add('dark-mode'); //bg-gray
            //document.nav.classList.add('bg-gray');
            // $(".main-header").addClass("bg-gray");
        },
        cambiomodoclaro() {
            this.modooscuro = false;
            document.body.classList.remove('dark-mode'); //bg-gray
            //document.nav.classList.add('bg-gray');
            // $(".main-header").removeClass("bg-gray");
        },

    },
};
</script>

<style lang="scss" scoped>
.navbar-dark {
    border-color: #ccc !important;
}
</style>
