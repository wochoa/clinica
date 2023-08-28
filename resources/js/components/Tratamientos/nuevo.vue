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
                        <div class="card-header p-1">
                            <h5>Odontograma</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <h4>Odontograma</h4> -->
                                <Odontograma ref="odo" />

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <!-- <div class="card-header">
                            Tratamiento al paciente
                        </div> -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Paciente:</label>
                                <el-select v-model="formtratamiento.idpaciente" filterable placeholder="Busque paciente" size='small' autocomplete style="width: 100%;">
                                    <el-option v-for="item in Listauser.data" :key="item.id" :label="item.num_doc+'-'+item.nombre +' '+item.ap_paterno" :value="item.id" v-if="item.name=='Paciente'">
                                    </el-option>
                                </el-select>
                            </div>
                            <div class="form-group">
                                <label for="">Título Diagnostico</label>
                                <input type="text" class="form-control form-control-sm" placeholder="P.ejem.:Tratamiento Ortodoncia" v-model="formtratamiento.titulo">
                            </div>
                            <div class="form-group">
                                <label for="">Diagnostico:</label>
                                <textarea name="" id="" cols="30" rows="5" class="form-control form-control-sm" placeholder="P. Ejemplo:  - 3 dientes para curaciones, - 1 diente para Extracción, etc" v-model="formtratamiento.diagnostico"></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Costo(S/.):</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" step="0.01" placeholder="0.0" v-model="formtratamiento.costo">
                                </div>
                                <label for="" class="col-sm-3">Adelanto(S/.):</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" step="0.01" placeholder="0.0" v-model="formtratamiento.adelanto">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger btn-sm" @click="imprimirproforma"><i class="fa-solid fa-print"></i> Imprimir proforma</button>

                                <button class="btn btn-dark btn-sm" @click="guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar diagnóstico</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

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
import {
    mapGetters
} from 'vuex';
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
    name: 'Nuevotratamiento',
    props: ['ruta', 'usuario'],
    data() {
        return {
            formtratamiento: {
                idpaciente: '',
                titulo: '',
                diagnostico: '',
                costo: 0,
                adelanto: 0
            },
            errorvalidacion: []
        }
    },
    components: {
        Odontograma
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
        // ...Vuex.mapActions(['imprimirDocumentoPdf']),
        toast(texto_anuncio, icono) {

            Toast.fire({
                // title:texto_titulo,
                title: '<small><strong>' + texto_anuncio + '</strong></small>',
                icon: icono,
                // text: texto_anuncio
            });
        },

        imprimirproforma() {
            window.print();
        },
        listadouser() {
            // this.Datauser()
            this.$store.dispatch('getUsuarios');
        },
        guardar() {
            
            
            // alert('hola');
            this.datosparaverificar();
            if (this.errorvalidacion.length > 0) {
                this.toast('Falta rellenar algunos datos', 'error');
                $("#mensajeeeror").modal('show')
            }
            else{
                this.$refs.odo.Guardardatos(this.formtratamiento)
                this.toast('Fue guardado con éxito su diagnóstico', 'success');
                this.limpiarcampos();
            }
        },
        datosparaverificar() {
            this.errorvalidacion=[]
            if (this.formtratamiento.idpaciente == '') {
                this.errorvalidacion.push('Falta seleccionar paciente');
            }
            if (this.formtratamiento.titulo == '') {
                this.errorvalidacion.push('Falta colocar el título de atención');
            }
            if (this.formtratamiento.diagnostico == '') {
                this.errorvalidacion.push('Falta describir la descripción');
            }
            if (this.formtratamiento.costo == 0) {
                this.errorvalidacion.push('Falta colocar el costo de tratamiento');
            }
            
        },
        
        limpiarcampos(){
            this.formtratamiento.idpaciente=''
            this.formtratamiento.titulo=''
            this.formtratamiento.diagnostico=''
            this.formtratamiento.costo=0
            this.formtratamiento.adelanto=0
        }

    }
}
</script>

<style lang="css" scoped>
.hideUpload>div {
    display: none;
}
</style>
