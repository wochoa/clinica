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
                            <router-link :to="'/'">Dashboard</router-link>
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
            <div class="row">
                <div class="col-lg-6 col-10">
                    <router-link :to="'/Tramites/Enproceso'" class="btn btn-info btn-sm"><i class="fa-regular fa-circle-left"></i> ir a documentos en proceso</router-link>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card card-primary card-outline ">
                        <div class="card-header p-1">
                            Usuarios
                        </div>
                        <div class="card-body">

                            <!-- {{-- para las opciones de busqueda --}} -->
                            <div class="row  mb-2">

                                <button type="button" class="btn btn-primary btn-sm mt-1" @click="nuevouser"><i class="fa-solid fa-user-plus"></i> NUEVO USUARIO</button>
                            </div>

                            <!-- {{-- para la relacion de datos --}} -->
                            <div class="row mt-2">
                                <table class=" table table-bordered table-condensed table-hover table-sm">
                                    <thead class="bg-lightblue  disabled color-palette pd-0">
                                        <tr class="info">
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
                                        <tr v-for="user in Listauser.data" :key="user.id">
                                            <!-- <td  colspan="21" class="text-center">
                                            No hay documentos, pruebe cambiando los filtros
                                        </td> -->
                                            <td><small>{{ user.id }}</small></td>
                                            <td><small>{{ user.nombre }} {{ user.ap_paterno }} {{ user.ap_materno }}</small>
                                            </td>

                                            <td><small>{{user.num_doc }}</small></td>
                                            <td><small>{{user.email }}</small></td>

                                            <td>

                                                {{user.celular }}

                                            </td>
                                            <td><small>{{ user.created_at}}</small></td>
                                            <td v-if="user.name=='Paciente'"><span class="badge badge-danger">{{ user.name}}</span></td>
                                            <td v-if="user.name=='Superadmin'"><span class="badge badge-dark">{{ user.name}}</span></td>
                                            <td v-if="user.name=='Cirujano'"><span class="badge badge-info">{{ user.name}}</span></td>

                                            <td class="text-center">
                                                <!-- <button class="btn btn-primary btn-sm"><i class="fa-solid fa-user-pen"></i></button>
                                            <router-link :to="'/Administracion/usuarios/edit/{{}}'">path route</router-link> -->
                                                <router-link :to="{name:'Editar usuario',params:{id:user.id }}" class="btn btn-xs btn-default"><i class="fa-solid fa-user-pen"></i></router-link>
                                                <a href="#" @click="borraruser(user.id )" class="btn btn-xs btn-default"><i class="fa-regular fa-trash-can"></i></a>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="row form-group mt-2">
                                <!-- <div class="col-6">
                                    <MenuDocuBuscar :userid="formData.idadmin" :doc-indexes="docIndexes" :documentos="documentos" @mostrar="mostrar" @editar="editar" @eliminarDerivacion="eliminarDerivacion" @responder="responder" />
                                </div> -->
                                <div class="col-6">
                                    <div class="float-right d-none d-sm-inline-block">
                                        <pagination :data="Listauser" :limit="3" @pagination-change-page="buscarusuarios" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <Modaluser ref="user" />

</div>
</template>

<script>
import {
    mapActions,
    mapGetters
} from 'vuex';
import LaravelVuePagination from 'laravel-vue-pagination';
import Modaluser from '../../Datospacientes/modalnewpaciente.vue';
import Swal from 'sweetalert2';
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        //toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

export default {

    data() {
        return {

        }
    },
    components: {
        Modaluser,
        'Pagination': LaravelVuePagination,
    },

    computed: {

        ...mapGetters(['Listauser'])
    },

    created() {
        this.listadouser()
    },
    methods: {
        ...mapActions(['Datauser']),
        toast(texto_anuncio, icono) {

            Toast.fire({
                // title:texto_titulo,
                title: '<small><strong>' + texto_anuncio + '</strong></small>',
                icon: icono,
                // text: texto_anuncio
            });
        },

        nuevouser() {
            this.$refs.user.nuevopaciente()
        },
        listadouser() {
            // this.Datauser()
            this.$store.dispatch('getUsuarios');
        },
        // buscarusuarios(page) {
        //     this.$store.dispatch('getUsuarios', page);
        // },
        buscarusuarios(page = 1) {
            this.$store.dispatch('getUsuarios', page);
            // console.log(page)
        },
        borraruser(id) {
            this.$store.dispatch('deleteUser', id);
            this.toast('Se eliminó el usuario de forma exitosa', 'success');
        }

    }
}
</script>

<style lang="css" scoped>
/* .pagination{
        margin-bottom: 0;
    } */
</style>
