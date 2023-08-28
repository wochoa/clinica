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
                <div class="col-8">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <button class="btn btn-primary btn-sm" @click.prevent="newgasto"><i class="fa-solid fa-circle-plus"></i> Nuevo registro de caja</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header p-1">
                            <h4>Caja diaria</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-sm">
                                <thead class="bg-lightblue  disabled color-palette">
                                    <tr class="headings">
                                        <th>Tipo </th>
                                        <th>Descripcion </th>
                                        <th>Monto </th>
                                        <th>Usuario </th>
                                        <th><span class="nobr"></span></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>Gasto</td>
                                        <td>EXPERIENCIA ESPECIFICA</td>
                                        <td>40.0000</td>
                                        <td>CAJAHUAMAN FLORES LUIS ANTONIO</td>
                                        <td>
                                            <button class="btn btn-default" title="Editar producto"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <button class="btn btn-default" title="Borrar producto"><i class="fa-regular fa-trash-can"></i></button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Ingreso</td>
                                        <td>Pago alquiler</td>
                                        <td>25.0000</td>
                                        <td>CAJAHUAMAN FLORES LUIS ANTONIO</td>
                                        <td>
                                            <button class="btn btn-default" title="Editar producto"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <button class="btn btn-default" title="Borrar producto"><i class="fa-regular fa-trash-can"></i></button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Busqueda</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header p-1">
                            <h4>Caja diaria <span id="mfecha">02/08/2023</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- ajax -->
                                <strong>
                                    <h4><i class="fa-solid fa-user-doctor fa-1x"></i> Usuario:CAJAHUAMAN FLORES LUIS ANTONIO</h4>
                                </strong>
                                <div class="ln_solid"></div>
                                <div class="cajas_div">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Rubro</th>
                                                <th>S/. </th>
                                                <th>$.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Atenciones</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                            </tr>
                                            <tr>
                                                <td>Caja diaria</td>
                                                <td>0.00</td>
                                                <td>0.00</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th>0.00</th>
                                                <th>0.00</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- modal agregar paciente -->
    <div class="modal fade" id="nuevogasto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo registro caja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="control-group row">
                        <label for="" class="col-sm-3">Fecha</label>
                        <div class="col-sm-9">
                            <input type="date" placeholder="Fecha" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="control-group row">
                        <label for="" class="col-sm-3">Descripcion</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Ingrese descripcion de gasto" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Medio de pago</label>
                        <div class="col-sm-9">
                            <select class="form-control form-control-sm">
                                <option value="1">Efectivo</option>
                                <option value="2">Yape</option>
                                <option value="3">Plim</option>
                                <option value="4">Visa</option>
                                <option value="5">Master Card</option>
                                <option value="6">Deposito</option>
                                <option value="7">Cheque</option>

                            </select>
                        </div>
                    </div>
                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Tipo</label>
                        <div class="col-sm-9">
                            <select class="form-control form-control-sm">
                                <option value="1">Ingreso</option>
                                <option value="2">Gasto</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Monto</label>
                        <div class="col-sm-2">
                            <select class="form-control form-control-sm">
                                <option value="1">S/.</option>
                                <option value="2">$.</option>
                            </select>
                        </div>
                        <div class="col-sm-7">
                            <input type="number" placeholder="Monto" class="form-control form-control-sm">
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

</div>
</template>

<script>
import axios from 'axios';

window.$ = window.jQuery = require('jquery')
export default {
    name: '',
    props: ['ruta', 'usuario'],
    data() {
        return {

        }
    },
    components: {

    },
    created() {

    },
    computed: {

    },
    mounted() {

        //this.formData.idadmin = this.usuario.id

    },
    methods: {
        // ...Vuex.mapActions(['imprimirDocumentoPdf']),

        newgasto() {
            $("#nuevogasto").modal('show');
            // $('#editPersona').modal('show'); 
        },

    }
}
</script>

<style lang="css" scoped>
.hideUpload>div {
    display: none;
}
</style>
