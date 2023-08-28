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
                    <button class="btn btn-info btn-sm" @click="retroceder()"><i class="fa-regular fa-circle-left"></i> Volver</button>
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
                                <Odontograma />

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
                                <el-select v-model="value" filterable placeholder="Select" size="small" style="width: 100%;">
                                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
                            </div>
                            <div class="form-group">
                                <label for="">Diagnostico:</label>
                                <textarea name="" id="" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Costo(S/.):</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" step="0.01" placeholder="0.0">
                                </div>
                                <label for="" class="col-sm-3">Adelanto(S/.):</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm" step="0.01" placeholder="0.0">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger btn-sm" @click="imprimirproforma"><i class="fa-solid fa-print"></i> Imprimir proforma</button>
                                <button class="btn btn-dark btn-sm"><i class="fa-solid fa-floppy-disk"></i> Guardar diagnóstico</button>
                            </div>
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
import Odontograma from './Odontograma.vue';
import swal from 'sweetalert2';
window.Swal = swal;

window.$ = window.jQuery = require('jquery')
export default {
    name: '',
    props: ['ruta', 'usuario'],
    data() {
        return {
            idpaciente: null,
            idcitas: null,

            options: [{
                value: 'id1',
                label: '42282733 - WILMER OCHAO ALVARADO'
            }, {
                value: 'id2',
                label: 'Option2'
            }, {
                value: 'id3',
                label: 'Option3'
            }, {
                value: 'id4',
                label: 'Option4'
            }, {
                value: 'id5',
                label: 'Option5'
            }],
            value: ''
        }
    },
    components: {
        Odontograma
    },
    created() {
        this.idpaciente = this.$route.params.idpaciente;
        this.idcitas = this.$route.params.idcitas;
        this.preguntatratamiento();

    },
    computed: {

    },
    mounted() {

        //this.formData.idadmin = this.usuario.id

    },
    methods: {
        // ...Vuex.mapActions(['imprimirDocumentoPdf']),

        imprimirproforma() {

            window.print();

        },
        retroceder() {
            window.history.back();
        },
        preguntatratamiento() 
        {
            Swal.fire({
                title: 'El paciente tiene tratamiento en curso, deseas agregar al mismo tratamiento?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'SI',//save
                denyButtonText: `INICIAR NUEVO TRATAMIENTO`,//
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Saved!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
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
