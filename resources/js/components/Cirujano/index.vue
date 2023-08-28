<template>
<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $route.name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link :to="'/home'">Dashboard</router-link>
                        </li>
                        <li class="breadcrumb-item active">{{ $route.name }}</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row" v-if="can('pacientes_create')">
                <div class="col-lg-6 col-10">
                    <button class="btn btn-primary btn-sm" @click.stop="newpaciente"><i class="fa-solid fa-user-plus"></i> Nuevo cirujano</button>
                </div>

            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-1">
                            <h5>Listado de cirujano dentista</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-sm">
                                <thead class="bg-lightblue disabled color-palette">
                                    <tr>
                                        <th><small><strong>ID</strong></small></th>
                                        <th><small><strong>NOMBRES</strong></small></th>

                                        <th><small><strong>DNI</strong></small></th>
                                        <th><small><strong>CORREO</strong></small></th>
                                        <th><small><strong>CELULAR</strong></small></th>
                                        <th><small><strong>FECHA REGISTRO</strong></small></th>
                                        <th><small><strong>ROL ASIGNADO</strong></small></th>
                                        <th><small><strong>ACCIONES</strong></small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in Listauser.data" :key="user.id" v-if="user.name=='Cirujano'">
                                        <td><small>{{ user.id }}</small></td>
                                        <td><small>{{ user.nombre }} {{ user.ap_paterno }} {{ user.ap_materno }}</small>
                                        </td>

                                        <td><small>{{user.num_doc }}</small></td>
                                        <td><small>{{user.email }}</small></td>

                                        <td>

                                            {{user.celular }}

                                        </td>
                                        <td><small>{{ user.created_at}}</small></td>
                                        <td><span class="badge badge-danger">{{ user.name}}</span></td>

                                        <td class="text-center">
                                            <!-- <button class="btn btn-primary btn-sm"><i class="fa-solid fa-user-pen"></i></button>
                                            <router-link :to="'/Administracion/usuarios/edit/{{}}'">path route</router-link> -->
                                            <router-link :to="{name:'Editar usuario',params:{id:user.id }}"><i class="fa-solid fa-user-pen"></i></router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <div class="float-right d-none d-sm-inline-block">
                                <pagination :data="Listauser" :limit="3" @pagination-change-page="buscarusuarios" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- modal agregar paciente -->
    <Modalnewpaciente ref="foo" />

</div>
</template>

<script>
import {
    mapActions,
    mapGetters
} from 'vuex';
import LaravelVuePagination from 'laravel-vue-pagination';
import Modalnewpaciente from '../Datospacientes/modalnewpaciente.vue';
window.$ = window.jQuery = require('jquery')
export default {
    name: '',
    props: ['ruta', 'usuario'],
    data() {
        return {

        }
    },
    components: {
        Modalnewpaciente,
        'Pagination': LaravelVuePagination,
    },
    created() {
        this.listadouser()
    },
    computed: {

        ...mapGetters(['Listauser'])
    },
    mounted() {


    },
    methods: {


        listadouser() {
            // this.Datauser()
            this.$store.dispatch('getUsuarios');
        },
        newpaciente() {

            // $('#editPersona').modal('show'); 

            this.$refs.foo.nuevopaciente()
        },
        buscarusuarios(page = 1) {
            this.$store.dispatch('getUsuarios', page);
            // console.log(page)
        }

    }
}
</script>

<style lang="css" scoped>
.hideUpload>div {
    display: none;
}
</style>
