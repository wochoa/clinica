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
                    <button class="btn btn-primary btn-sm" @click.prevent="newgasto"><i class="fa-solid fa-circle-plus"></i> Nuevo gasto</button>
                </div>

            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-1">
                            <h5>Listado de gastos</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm table-hover">
                                <thead class="bg-lightblue  disabled color-palette">
                                    <tr>
                                        <th>ID</th>
                                        <th>Descripción </th>
                                        <th>Monto </th>
                                        <th>Fecha </th>
                                        <th>Usuario </th>
                                        <th>Editar </th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Pago alquiler</td>
                                        <td>25.00</td>
                                        <td>2023-08-02 00:00:00</td>
                                        <td>DEYSI JANETH SALVATIERRA</td>
                                        <td><button class="btn btn-default" title="Editar producto"><i class="fa-regular fa-pen-to-square"></i></button></td>
                                        <td><button class="btn btn-default" title="Borrar producto"><i class="fa-regular fa-trash-can"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-6 border rounded mt-3">
                                    <p class="pt-2">
                                        <strong>Total Gastos Generados:</strong> S/.25.00
                                    </p>
                                </div>
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
                    <h4 class="modal-title">Nuevo Gasto</h4>
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
                        <label for="" class="col-sm-3">Fmedio de pago</label>
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
                    <div class="control-group row mt-2">
                        <label for="" class="col-sm-3">Detalle</label>
                        <div class="col-sm-9">
                            <textarea  cols="30" rows="4" class="form-control form-control-sm"></textarea>
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
