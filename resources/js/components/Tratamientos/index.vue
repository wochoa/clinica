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
            <div class="row" v-if="can('tratamientos_create')">
                <div class="col-lg-6 col-10">
                    <a href="/tratamientos/nuevo-tratamientos" class="btn btn-primary btn-sm"><i class="fa-solid fa-user-check"></i> Registrar nuevo paciente y su tratamiento</a>
                </div>

            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-1">
                            <h5>Listado de tratamientos a los pacientes</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-sm">
                                <thead class="bg-lightblue disabled color-palette">
                                    <tr>
                                        <th>ID</th>
                                        <th>PACIENTES</th>
                                        <th>TRATAMIENTO</th>
                                        <th>DIAGNOSTICO</th>
                                        <th>COSTO TOTAL</th>
                                        <th>CELULAR</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in datatratamiento" >
                                        <td>{{ item.idtratamientos }}</td>
                                        <td>
                                            <b>Nombre:</b> {{ item.nombre }} {{ item.ap_paterno }} {{ item.ap_materno }}<br>
                                            <b>DNI:</b> {{ item.num_doc }}<br>
                                            <b>CEL:</b> {{ item.celular }}<br>
                                            <b>EMAIL:</b> {{ item.email }}
                                        
                                        </td>
                                        <td>{{ item.titulo_tratamiento }}</td>
                                        <td>{{ item.diagnostico }}</td>
                                        <td><span class="badge badge-danger">S/.{{ item.costo_total }}</span></td>
                                        <td>912963711</td>
                                        <td>
                                            <!-- <button class="btn btn-sm btn-primary"><i class="fa-solid fa-clipboard-user"></i> Historial tratamientos</button> -->
                                            <!-- <button class="btn btn-sm btn-info">Agregar tratamientos</button> -->
                                            <a :href="'/tratamientos/'+item.idtratamientos+'/historial'" class="btn btn-xs btn-warning"><i class="fa-solid fa-clipboard-user"></i> HISTORIAL DE TRATAMIENTOS</a>
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

    <!-- modal agregar paciente -->
    <div class="modal fade" id="nuevacita">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar nueva cita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="control-group row">
                                <label for="" class="col-sm-3">DNI</label>
                                <div class="col-sm-9">
                                    <el-select v-model="value" filterable placeholder="Select" size='small' autocomplete style="width: 100%;">
                                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="">Nombres y apellidos</label>
                                <input type="text" placeholder="Nombres y apellidos" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary btn-sm" @click.prevent="newpaciente">Es nuevo paciente?</button>
                        </div>

                    </div>

                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Tipo cita</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm">
                                <option value="1">Primera vez</option>
                                <option value="2">Seguimiento</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Fecha cita</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Hora cita</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm">
                                <option value="8:00">8:00</option>
                                <option value="8:30">8:30</option>
                                <option value="9:00">9:00</option>
                                <option value="9:30">9:30</option>
                                <option value="10:00">10:00</option>
                                <option value="10:30">10:30</option>
                                <option value="11:00">11:00</option>
                                <option value="11:30">11:30</option>
                                <option value="12:00">12:00</option>
                                <option value="12:30">12:30</option>
                                <option value="13:00">13:00</option>
                                <option value="13:30">13:30</option>
                                <option value="14:00">14:00</option>
                                <option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
                                <option value="16:00">16:00</option>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                                <option value="20:30">20:30</option>
                                <option value="21:00">21:00</option>
                                <option value="21:30">21:30</option>
                                <option value="22:00">22:00</option>
                                <option value="22:30">22:30</option>
                                <option value="23:00">23:00</option>
                                <option value="23:30">23:30</option>
                                <option value="24:00">24:00</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <Modalnewpaciente ref="foo" />

</div>
</template>

<script>

import Modalnewpaciente from '../Datospacientes/modalnewpaciente.vue';
window.$ = window.jQuery = require('jquery')
export default {
    name: '',
    props: ['ruta', 'usuario'],
    data() {
        return {
            datatratamiento:[],
            options: [{
                value: 'Option1',
                label: 'Option1'
            }, {
                value: 'Option2',
                label: 'Option2'
            }, {
                value: 'Option3',
                label: 'Option3'
            }, {
                value: 'Option4',
                label: 'Option4'
            }, {
                value: 'Option5',
                label: 'Option5'
            }],
            value: ''
        }
    },
    components: {
        Modalnewpaciente
    },
    created() {
        this.cargatratamientos();

    },
    computed: {

    },
    mounted() {

        //this.formData.idadmin = this.usuario.id

    },
    methods: {
        // ...Vuex.mapActions(['imprimirDocumentoPdf']),

        newcita() {
            $("#nuevacita").modal('show');
            // $('#editPersona').modal('show'); 
        },
        newpaciente() {
            this.$refs.foo.nuevopaciente()
        },
        cargatratamientos()
        {
            var url='/listatratamiento'
            axios.get(url).then(res=>{
               this.datatratamiento=res.data; 
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
