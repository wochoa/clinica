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
    <div class="content" id="imprimir">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-10">
                    <router-link :to="'/tratamientos'" class="btn btn-primary btn-sm"><i class="fa-solid fa-circle-arrow-left"></i> Volver a tratamiento</router-link>
                </div>

            </div>

            <div class="row mt-2">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header pb-1">
                            <!-- <h5><i class="fa-solid fa-tooth"></i> Historial de tratamiento</h5> -->
                            <h3 class="card-title"> <i class="fa-solid fa-tooth"></i>Odontograma de tratamiento</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <h4>Odontograma</h4> -->
                                <Odontograma :idtratamiento="idtratamiento" ref="upd" />

                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa-solid fa-tooth"></i>Historial de tratamiento</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-xs btn-dark" @click="agregartratamiento" v-if="can('tratamientos_create')"><i class="fa-solid fa-calendar-plus"></i> Nuevo tratamiento</button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="timeline">
                                        <!-- timeline time label -->
                                        <template v-for="his in historial">

                                            <div class="time-label">
                                                <!-- <span class="bg-gray">04 Ago. 2023</span> -->
                                                <span class="bg-gray">{{ moment(his.created_at).format('DD-MMM-YYYY') }} </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <!-- <i class="fas fa-envelope bg-blue"></i> -->
                                                <i class="fas fa-user-doctor bg-dark"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> {{ moment(his.created_at).format('h:mm:ss a') }} </span>
                                                    <h3 class="timeline-header"><a href="#">Tratamiento:</a> {{ his.tit_diagnostico }}</h3>

                                                    <div class="timeline-body">
                                                        <p class="p-0">
                                                            {{ his.text_diagnostico }}
                                                        </p>

                                                    </div>
                                                    <div class="timeline-footer">

                                                        <!-- <h5>S/. {{ parseFloat(his.pago_adelanto).toFixed(2) }}</h5> -->

                                                        
                                                            <a class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                                                            <a class="btn btn-danger btn-sm"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
                                                            <a class="btn btn-info btn-sm" disabled><i class="fa-solid fa-tooth"></i> Odontograma atención</a>
                                                            <span class="float-right badge bg-gray">
                                                                <b>Pago realizado:</b> S/. {{ parseFloat(his.pago_adelanto).toFixed(2) }}
                                                            </span>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                        </template>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center" id="foto">
                                <!-- <img class="profile-user-img img-fluid img-circle" src="/dist/img/user4-128x128.jpg" alt="User profile picture"> -->
                            </div>

                            <h3 class="profile-username text-center">{{ tratamiento.nombre }} {{ tratamiento.ap_paterno }} {{ tratamiento.ap_materno }}</h3>

                            <table class="table table-bordered">
                                <tr>
                                    <td><b>Tratamiento:</b></td>
                                    <td>{{ tratamiento.titulo_tratamiento }}</td>
                                </tr>
                                <tr>
                                    <td><b>Diagnostico:</b></td>
                                    <td>{{ tratamiento.diagnostico }}</td>
                                </tr>

                            </table>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item text-center text-gray p-0">
                                    MONTO PRESUPUESTADO TOTAL:<h4> S/. {{ parseFloat(tratamiento.costo_total).toFixed(2)  }}</h4>
                                </li>
                                <li class="list-group-item text-center text-gray p-0">
                                    MONTO PAGADO:<h4> S/. {{parseFloat(tottaladelantos).toFixed(2)}}</h4>
                                </li>
                                <li class="list-group-item text-center text-gray p-0">
                                    MONTO RESTANTE:<h4> S/. {{ parseFloat(tratamiento.costo_total-tottaladelantos).toFixed(2) }}</h4>
                                </li>

                            </ul>

                            <router-link :to="'/citas/nuevacita'" class="btn btn-danger btn-block"><i class="fa-solid fa-tooth"></i> <b>FINALIZAR TRATAMIENTO</b></router-link>
                            <p>
                                <small>
                                    <b>Nota:</b> Al finalizar el tratamiento: <b>{{ tratamiento.titulo_tratamiento }}</b>, se entendera que se habrá completado todo el proceso de tratamiento, de lo contrario si continua el proceso de tratamiento no debe finalizar.
                                </small>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- modal agregar paciente -->
    <div class="modal fade" id="nuevotrata">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar nuevo tratamiento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="control-group">
                        <label for="">Titulo tratamiento</label>
                        <input type="text" class="form-control form-control-sm" v-model="formupdtratamiento.titulo" placeholder="P.ejem. Curaciones y extracciones">
                    </div>
                    <div class="control-group">
                        <label for="">Detalle tratamiento</label>
                        <textarea cols="30" rows="5" class="form-control form-control-sm" v-model="formupdtratamiento.diagnostico" placeholder="P.ejem. - Diente 14 fue realizado la curación con resina y - Diente 11 fue realizada la extracción por presencia de daños con la raíz"></textarea>
                    </div>
                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-2 float-right">Costo(S/.)</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control form-control-sm" placeholder="130.50" v-model="formupdtratamiento.adelanto" min="0" :max="parseFloat(tratamiento.costo_total-tottaladelantos).toFixed(2)" step="0.01">
                        </div>
                        <div class="col-sm-6">
                            MONTO RESTANTE:<h4> S/. {{ parseFloat(tratamiento.costo_total-tottaladelantos).toFixed(2) }}</h4>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click.prevent="saveUpdate">Guardar</button>
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
import moment from "moment";
import axios from 'axios';
import Odontograma from './Odontograma.vue';
window.$ = window.jQuery = require('jquery')
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
    props: {
        ruta: '',
        usuario: '',
        diagnostico: {
            type: Array
        }
    },
    data() {
        return {
            idtratamiento: null,
            tratamiento: [],
            historial: [],
            tottaladelantos: null,
            formupdtratamiento: {
                idtratamiento: '',
                titulo: '',
                diagnostico: '',
                adelanto: 0,
            },
            errorvalidacion: []
        }
    },
    components: {
        Odontograma
    },
    created() {
        this.idtratamiento = this.$route.params.id;
        this.formupdtratamiento.idtratamiento = this.$route.params.id;
        this.cargaTratamiento();

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
        moment(a) {
            return moment(a)
        },
        // ...Vuex.mapActions(['imprimirDocumentoPdf']),

        imprimirproforma() {

            window.print();

        },
        agregartratamiento() {
            $('#nuevotrata').modal('show')
        },
        cargaTratamiento() {
            var url = '/listatratamiento/' + this.idtratamiento
            axios.get(url).then(res => {
                this.tratamiento = res.data.tratamiento[0];
                this.historial = res.data.historial;
                this.odontogeneral = res.data.odontogeneral
                this.tottaladelantos = res.data.sumaadelanto
                var strhtlm = '<img src="data:image/png;base64,' + this.tratamiento.foto + '" class="profile-user-img img-fluid img-circle" alt="">'
                // console.log(datos.data.foto)
                $('#foto').html(strhtlm);
                this.formupdtratamiento.titulo = this.tratamiento.titulo_tratamiento
                this.formupdtratamiento.diagnostico = this.tratamiento.diagnostico

            })
        },
        saveUpdate() {

            this.datosparaverificar();
            if (this.errorvalidacion.length > 0) {
                this.toast('Falta rellenar algunos datos', 'error');
                $("#mensajeeeror").modal('show')
            } else {
                this.$refs.upd.actualizadatos(this.formupdtratamiento)
                this.toast('Fue guardado con éxito su diagnóstico', 'success');
                this.limpiarcampos();
                $("#nuevotrata").modal('hide')
                
            }

            // this.$refs.odo.Guardardatos
        },
        datosparaverificar() {
            this.errorvalidacion = []

            if (this.formupdtratamiento.titulo == '') {
                this.errorvalidacion.push('Falta colocar el título de atención');
            }
            if (this.formupdtratamiento.diagnostico == '') {
                this.errorvalidacion.push('Falta describir el diagnóstico de atención');
            }
            if (this.formupdtratamiento.adelanto == 0) {
                this.errorvalidacion.push('Falta colocar el pago/adelanto de tratamiento');
            }

        },

        limpiarcampos() {
            this.formupdtratamiento.titulo = ''
            this.formupdtratamiento.diagnostico = ''
            this.formupdtratamiento.adelanto = 0
        }

    }
}
</script>

<style lang="css" scoped>
.hideUpload>div {
    display: none;
}
</style>
