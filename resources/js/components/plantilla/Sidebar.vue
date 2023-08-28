<template>
<div>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link :to="'/home'" class="brand-link text-decoration-none">
            <!-- <a href="index3.html" class="brand-link text-decoration-none"> -->
            <img :src="ruta+'/../dist/img/AdminLTELogo.png'" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light ">Administrador</span>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="ruta+'/../dist/img/user2-160x160.jpg'" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <!-- <a href="#" class="d-block text-decoration-none">{{usuario.fullname}}</a> -->
                    <router-link :to="{name:'Editar usuario',params:{id:usuario.id }}" class="d-block text-decoration-none">{{usuario.nombre}}</router-link>
                </div>
            </div>
            <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">

                    <a href="#" class="d-block text-decoration-none" @click="logout">

                        <i class="fas fa-sign-out-alt"></i> Cerrar session
                    </a>
                </div>
            </div> -->

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link :to="'/home'" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </router-link>

                    </li>
                    <li class="nav-header">Sistema Odontologia</li>

                    <li class="nav-item" v-if="can('citas_index')">
                        <router-link :to="'/citas'" class="nav-link">
                            <i class="fa-solid fa-truck-medical nav-icon"></i>
                            <p>Registro de citas</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="can('pacientes_index')">
                        <router-link :to="'/pacientes'" class="nav-link">
                            <i class="fa-solid fa-bed-pulse nav-icon"></i>
                            <p>Pacientes</p>
                        </router-link>
                    </li>

                    <li class="nav-item" v-if="can('tratamientos_index')">
                        <router-link :to="'/tratamientos'" class="nav-link">
                            <i class="fa-solid fa-suitcase-medical nav-icon"></i>
                            <p>Tratamientos</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="can('cirujano_index')">
                        <router-link :to="'/cirujano'" class="nav-link">
                            <i class="fa-solid fa-user-doctor nav-icon"></i>
                            <p>Cirujan@ Dentista</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="can('gastos_index')">
                        <router-link :to="'/gastos'" class="nav-link">
                            <i class="fa-solid fa-comments-dollar nav-icon"></i>
                            <p>Gastos</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="can('caja_index')">
                        <router-link :to="'/cajadiaria'" class="nav-link">
                            <i class="fa-solid fa-box-open nav-icon"></i>
                            <p>Caja diaria</p>
                        </router-link>
                    </li>

                    <li class="nav-item" v-if="can('usuario_index')">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-search"></i>
                            <p>
                                Administración
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" >
                            
                            <li class="nav-item">
                                <router-link :to="'/Administracion/usuarios'" class="nav-link">
                                    <i class="fa-regular fa-circle-user nav-icon"></i>
                                    <p>Usuarios</p>
                                </router-link>
                            </li>
                            
                            <li class="nav-item" v-if="is('Superadmin')">
                                <router-link :to="'/Administracion/rolesypermisos'" class="nav-link">
                                    <i class="fa-regular fa-circle-user nav-icon"></i>
                                    <p>Roles y permisos</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'StdvSidebar',
    props: ['ruta', 'usuario'],

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
