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
            <div class="row">
                <div class="col-lg-6 col-10">
                    <!-- <button class="btn btn-primary btn-sm" @click.prevent="newcita"><i class="fa-solid fa-hospital-user"></i> Nuevo cita</button> -->
                    <router-link :to="'/citas/nuevacita'" class="btn btn-primary btn-sm" v-if="can('citas_create')"><i class="fa-solid fa-hospital-user"></i> Nuevo cita</router-link>
                    <!-- <button class="btn btn-primary btn-sm" @click.prevent="calendario"><i class="fa-solid fa-hospital-user"></i> Ver calendario</button> -->
                    <router-link :to="'/citas/calendariocitas'" class="btn btn-primary btn-sm" v-if="can('citascli_create')"><i class="fa-solid fa-hospital-user"></i> Ver calendario citas</router-link>
                </div>

            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-1">
                            <h5>Listado de citas</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm table-hover">
                                <thead class="bg-lightblue disabled color-palette">
                                    <tr>
                                        <th>ID</th>
                                        <th>DNI</th>
                                        <th>DETALLES Y NOMBRES</th>
                                        <th>FECHA PROGRAMADA CITA</th>
                                        <th>HORA CITA</th>
                                        <th>SERVICIO</th>
                                        <th>ESTADO CITA</th>                                        

                                        <th v-if="can('citas_edit')">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in listacitas">
                                        <td>{{ item.idcitas }}</td>
                                        <td>{{ item.num_doc }}</td>
                                        <td>
                                            <b>NOMBRES:</b>  {{ item.nombre }} {{ item.ap_paterno }} {{ item.ap_materno }} <br>
                                            <b>CELULAR:</b>  {{ item.celular }}  <br>
                                            <b>CORREO:</b>  {{ item.email }}  <br>
                                        </td>
                                        <td>{{ item.fecha_inicial }}</td>
                                        <td>{{ item.hora_inicial }}</td>
                                        <td>{{ item.idservicio }}</td>
                                        <td v-if="item.atendido==0"><span class="badge badge-danger"> POR ATENDER</span></td>
                                        <td v-if="can('citas_edit')">
                                            <button class="btn btn-sm btn-primary"><i class="fa-solid fa-user-pen"></i> Editar cita</button>
                                            <a :href="'/tratamientos/tratamiento-paciente/'+item.idpaciente+'/'+item.idcitas" class="btn btn-sm btn-info"><i class="fa-solid fa-user-doctor"></i>  Iniciar tratamiento</a>
                                            <!-- <router-link :to="{name:'Atención tratamiento',params:{id:item.idpaciente,idcitas:item.idcitas }}" class="btn btn-sm btn-info"><i class="fa-solid fa-user-doctor"></i>  Iniciar tratamiento</router-link> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

</div>
</template>

<script>
window.$ = window.jQuery = require('jquery')
export default {
    name: '',
    props: ['ruta', 'usuario'],
    data() {
        return {
            listacitas: []

        }
    },
    components: {

    },
    created() {
        this.citaspendeintes();
    },
    computed: {

    },
    mounted() {

        //this.formData.idadmin = this.usuario.id

    },
    methods: {

        citaspendeintes() {
            var url = '/citaspendientes';
            axios.get(url).then(res => {
                this.listacitas = res.data;
            })
        }
    }
}
</script>

<style lang="css" scoped>
.hideUpload>div {
    display: none;
}
</style>
