<template>
    <div>
        <nav class="main-header navbar navbar-expand-md navbar-dark custom-nav shadow-sm">
            <div class="container">
                <a href="/" class="navbar-brand d-flex align-items-center">
                    <img :src="urlini+'/../dist/img/logo SD-.png'" alt="Logo" class="brand-image-xl">
                </a>

                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item px-2">
                            <a href="/" class="nav-link font-weight-bold">INICIO</a>
                        </li>
                        <li class="nav-item px-2">
                            <a href="#" class="nav-link font-weight-bold">CONTACTANOS</a>
                        </li>
                        
                        <li class="nav-item px-2">
                            <a class="nav-link mode-toggle" href="#" role="button" @click.prevent="toggleMode">
                                <i :class="modooscuro ? 'fa-solid fa-sun text-warning' : 'fa-regular fa-moon'"></i>
                            </a>
                        </li>

                        <li class="nav-item ml-md-3">
                            <template v-if="logeado">
                                <a href="/home" class="btn btn-outline-light btn-rounded px-4 shadow-sm">
                                    <i class="fa-solid fa-user-circle mr-1"></i> {{ usuario.name }}
                                </a>
                            </template>
                            <template v-else>
                                <a href="/login" class="btn btn-light btn-rounded px-4 text-primary font-weight-bold shadow-sm">
                                    INGRESAR
                                </a>
                            </template>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
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
    methods: {
        toggleMode() {
            this.modooscuro = !this.modooscuro;
            if (this.modooscuro) {
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.remove('dark-mode');
            }
        }
    },
};
</script>

<style lang="scss" scoped>
// Fuente moderna (asegúrate de incluirla en tu layout principal)
.custom-nav {
    background: linear-gradient(90deg, #0bb9b7 0%, #037ad6 100%) !important;
    border: none !important;
    padding: 0.8rem 0;
    transition: all 0.3s ease;
    
    .nav-link {
        font-size: 0.85rem;
        letter-spacing: 1px;
        transition: opacity 0.3s;
        
        &:hover {
            opacity: 0.8;
            color: #fff !important;
        }
    }
}

.brand-image-xl {
    height: 55px; // Ajusta según tu logo
    transition: transform 0.3s ease;
    &:hover {
        transform: scale(1.05);
    }
}

.btn-rounded {
    border-radius: 50px;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.mode-toggle {
    font-size: 1.2rem;
    padding: 0 10px;
}

// Estilo para modo oscuro si el navbar debe cambiar
.dark-mode .custom-nav {
    background: #1a1a1a !important;
    border-bottom: 1px solid #333 !important;
}
</style>
