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
                    <div class="col-md-4">
                        <div class="card">
                            <router-link :to="'/citas'" class="btn btn-primary btn-sm"><i class="fa-regular fa-circle-left"></i> Volver listado de citas</router-link>
                        </div>
                        <div class="sticky-top mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Datos nueva cita</h4>
                                    <div class="float-right">
                                        <button class="btn btn-primary btn-xs" @click.prevent="newpaciente">Es nuevo paciente?</button>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <!-- the events -->
                                    <div class="form-group row">
                                        <!-- <label for="" class="col-sm-3">Programación:</label> -->
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <el-radio v-model="vacaciones" label="0">Vacaciones o feriados</el-radio>
                                            <el-radio v-model="vacaciones" label="1">Programación cita</el-radio>
                                        </div>
                                    </div>
                                    <div class="control-group row" v-if="vacaciones=='1'">
                                        <label for="" class="col-sm-3">DNI</label>
                                        <div class="col-sm-9">
                                            <el-select v-model="formcita.idpaciente" filterable placeholder="Busque paciente" size='small' autocomplete style="width: 100%;">
                                                <el-option v-for="item in Listauser.data" :key="item.id" :label="item.num_doc+'-'+item.nombre +' '+item.ap_paterno" :value="item.id" v-if="item.name=='Paciente'">
                                                </el-option>
                                            </el-select>
                                        </div>
                                    </div>

                                    <div class="control-group row mt-2" v-if="vacaciones=='1'">
                                        <label for="" class="col-sm-3">Tipo cita</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" v-model="formcita.tipo">
                                                <option value="PRIMERA VEZ">PRIMERA VEZ</option>
                                                <option value="SEGUIMIENTO">SEGUIMIENTO</option>
                                                <option value="OTROS">OTROS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group row mt-2" v-if="vacaciones=='1'">
                                        <label for="" class="col-sm-3">Servicio</label>
                                        <div class="col-sm-9">
                                            <el-select v-model="formcita.idservicios" filterable placeholder="Busque paciente" size='small' autocomplete style="width: 100%;">
                                                <el-option v-for="ser in dataservicios" :key="ser.idservicios" :label="ser.nom_servicio" :value="ser.idservicios">
                                                </el-option>
                                            </el-select>
                                        </div>
                                    </div>
                                    <div class="control-group row mt-2">
                                        <label for="" class="col-sm-3">Fecha Inicio</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" v-model="formcita.fechaini" required>
                                        </div>
                                    </div>
                                    <div class="control-group row mt-2" v-if="vacaciones=='0'">
                                        <label for="" class="col-sm-3">Fecha Fin</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" v-model="formcita.fechafin">
                                        </div>
                                    </div>
                                    <div class="control-group row mt-2">
                                        <label for="" class="col-sm-3">Hora inicio</label>
                                        <div class="col-sm-9">
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
                                    <div class="control-group row mt-2" v-if="vacaciones=='1'">
                                        <label for="" class="col-sm-3">Hora final</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-sm" v-model="formcita.hora_fin">
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
                                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                        <ul class="fc-color-picker" id="color-chooser">
                                            <li><a class="text-primary" href="#" @click="colorevento('#007afe')"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-warning" href="#" @click="colorevento('#ffc107')"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-success" href="#" @click="colorevento('#28a745')"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-danger" href="#" @click="colorevento('#dc3545')"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-muted" href="#" @click="colorevento('#6c757d')"><i class="fas fa-square"></i></a></li>
                                        </ul>
                                        <small class="mt-3" :style="'color:'+formcita.color+''">Color Seleccionado: {{ formcita.color }}</small>
                                    </div>
                                    <div class="input-group" v-if="vacaciones=='0'">
                                        <input id="new-event" type="text" class="form-control" placeholder="Título por vacciones o feriados" v-model="formcita.titulo">

                                        <!-- /btn-group -->
                                    </div>
                                    <div class="form-gorup row mt-2 d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary" @click="citanueva">Agregrar Cita</button>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-8">
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
    <Modalnewpaciente ref="foo" />

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
import Modalnewpaciente from '../Datospacientes/modalnewpaciente.vue';
import {
    mapActions,
    mapGetters
} from 'vuex';
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
                tipo: '',
                fechaini: '',
                fechafin: '',
                hora_ini: '',
                hora_fin: '',
                color: '',
                titulo: '',
                idservicios: ''
            },
            datoverificado: 0,
            vacaciones: '1',
            dataservicios: [],
            errorvalidacion: []

        }
    },
    components: {
        Calendario,
        Modalnewpaciente
    },
    created() {
        this.listadouser();
        this.listaservicios();
    },
    computed: {
        ...mapGetters(['Listauser'])
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
        newpaciente() {
            this.$refs.foo.nuevopaciente()
        },
        listadouser() {
            // this.Datauser()
            this.$store.dispatch('getUsuarios');
        },
        listaservicios() {
            var url = '/servicios';
            axios.get(url).then(res => {
                this.dataservicios = res.data
            })
        },
        citanueva() {
            this.opcion_vacaciones();
            this.compruebadatos();
            var url = '/nuevacita'
            if (this.errorvalidacion.length > 0) {
                this.toast('Falta rellenar algunos datos', 'error');
                $("#mensajeeeror").modal('show')
            } else {
                axios.post(url, this.formcita).then(res => {
                    this.$refs.new.cargacalendaio()
                    this.toast('Fue programada con éxito la cita', 'success');
                })

            }

        },
        opcion_vacaciones() {
            if (this.vacaciones == '0') {
                this.formcita.tipo = "OTROS";
                this.formcita.hora_fin = this.formcita.hora_ini;
            } else {
                this.formcita.fechafin = this.formcita.fechaini;
                this.formcita.color = '#28a745';

            }

            // alert(this.vacaciones)

        },
        colorevento(codigo) {
            this.formcita.color = codigo;
        },
        compruebadatos() {
            // const array=[];
            this.errorvalidacion = [];
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
            if (this.formcita.hora_fin == '') {
                this.errorvalidacion.push('Falta ingresar hora final');
            }
            if (this.formcita.color == '') {
                this.errorvalidacion.push('Falta ingresar color');
            }

            if (this.vacaciones == '0') {
                if (this.formcita.titulo == '') {
                    this.errorvalidacion.push('Falta ingresar titulo de evento');
                }

            }
            else{
                if (this.formcita.idpaciente == '') {
                    this.errorvalidacion.push('Falta seleccionar al paciente');
                }
                if (this.formcita.idservicios == '') {
                    this.errorvalidacion.push('Falta seleccionar el servicio');
                }
            }

            // console.log(this.errorvalidacion);
            // console.log(this.errorvalidacion[0]);

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
