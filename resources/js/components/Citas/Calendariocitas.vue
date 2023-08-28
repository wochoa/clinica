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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-10">
                        <router-link :to="'/citas'" class="btn btn-primary btn-sm"><i class="fa-regular fa-circle-left"></i> Volver listado de citas</router-link>
                    </div>

                </div>
                <div class="row mt-1">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="/dist/img/user4-128x128.jpg" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ usuario.nombre }} {{ usuario.ap_paterno }} {{ usuario.ap_materno }}</h3>

                                <p class="text-muted text-center">Paciente</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item text-center">
                                        Estimado(a) estos son los calendarios de citas del<br> <b>Centro Odontológico SD</b>
                                    </li>

                                </ul>

                                <button class="btn btn-primary btn-block" @click.prevent="agendarcitas" v-if="can('citascli_create')"><b>Deseo agendar cita</b></button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <Calendario ref="new" />
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content -->

    <div class="modal fade" id="newcitapaciente">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-1">
                    <h4 class="modal-title">Nueva cita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="/dist/img/user4-128x128.jpg" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">Hola, <b>{{ usuario.nombre }} {{ usuario.ap_paterno }} {{ usuario.ap_materno }}</b></h3>

                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Fecha cita</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control form-control-sm" v-model="formcita.fechaini">
                        </div>
                    </div>
                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Hora cita</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" v-model="formcita.hora_ini">
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
                            </select>
                        </div>
                    </div>
                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Tema cita</label>
                        <div class="col-sm-8">
                            <el-select v-model="formcita.idservicios" filterable placeholder="Busque paciente" size='small' autocomplete style="width: 100%;">
                                <el-option v-for="ser in dataservicios" :key="ser.idservicios" :label="ser.nom_servicio" :value="ser.idservicios">
                                </el-option>
                            </el-select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="citanueva">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="mensajeeeror">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="callout callout-danger" v-for="erro in errorvalidacion">
                        <h5>{{ erro }}</h5>
                    </div>
                </div>
                <div class="modal-footer float-right p-1">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
</template>

<script>
import Calendario from './Calendario.vue'

// window.$ = window.jQuery = require('jquery')
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
    name: '',
    props: ['ruta', 'usuario'],
    data() {
        return {
            formcita: {
                idpaciente: '',
                tipo: 'PRIMERA VEZ',
                fechaini: '',
                fechafin: '',
                hora_ini: '',
                hora_fin: '',
                color: '',
                idservicios: ''
            },
            dataservicios: [],
            errorvalidacion: []
        }
    },
    components: {
        Calendario,

    },
    created() {
        this.listaservicios()
    },
    computed: {

    },
    mounted() {

        //this.formData.idadmin = this.usuario.id

    },
    methods: {
        toast(texto_anuncio, icono) {

            Toast.fire({
                // title:texto_titulo,
                title: '<small><strong>' + texto_anuncio + '</strong></small>',
                icon: icono,
                // text: texto_anuncio
            });
        },
        agendarcitas() {
            $("#newcitapaciente").modal('show');
        },
        listaservicios() {
            var url = '/servicios';
            axios.get(url).then(res => {
                this.dataservicios = res.data
            })
        },
        citanueva() {
            var url = '/nuevacitapaciente'
            this.compruebadatos();
            if (this.errorvalidacion.length > 0) {
                this.toast('Falta rellenar algunos datos', 'error');
                $("#mensajeeeror").modal('show')
            } else {
                axios.post(url, this.formcita).then(res => {
                    this.$refs.new.cargacalendaio()
                    this.toast('Fue programada con éxito su cita', 'success');
                    $("#newcitapaciente").modal('hide');
                })

            }
        },
        compruebadatos() {
            // const array=[];
            this.errorvalidacion = [];

            this.formcita.fechafin = this.formcita.fechaini;
            this.formcita.color = '#28a745'
            this.formcita.idpaciente = this.usuario.id

            if (this.formcita.tipo == '') {
                this.errorvalidacion.push('Falta seleccionar el tipo de cita');
            }
            if (this.formcita.fechaini == '') {
                this.errorvalidacion.push('Falta ingresar fecha inicial');
            }
            if (this.formcita.fechafin == '') {
                this.errorvalidacion.push('Falta ingresar fecha final');
            }
            if (this.formcita.hora_ini == '') {
                this.errorvalidacion.push('Falta ingresar hora inicial');
            }

            if (this.formcita.color == '') {
                this.errorvalidacion.push('Falta ingresar color');
            }

            if (this.formcita.idservicios == '') {
                this.errorvalidacion.push('Falta seleccionar el servicio');
            }
            // console.log()

            // this.errorvalidacion.push(array);
        }

    }
}
</script>

<style lang="css" scoped>
.hideUpload>div {
    display: none;
}
</style>
