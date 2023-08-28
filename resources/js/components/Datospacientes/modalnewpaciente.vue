<template>
<div>
    <div class="modal fade" id="newpaciente">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header" v-if="is('Superadmin')">
                    <h4 class="modal-title"><i class="fa-solid fa-user-plus fa-1x"></i> Agregar nuevo usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-header" v-else>
                    <h4 class="modal-title">Agregar nuevo paciente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 border-right">
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="control-group row">
                                        <label for="" class="col-sm-3">DNI</label>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" placeholder="digite su dni" v-model="datouser.dni">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-info btn-flat" @click="buscardni"><i class="fa-solid fa-magnifying-glass"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="control-group row mt-2">
                                <label for="" class="col-sm-3">Nombres</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="Nombres" class="form-control form-control-sm" v-model="datouser.nombres">
                                </div>
                            </div>
                            <div class="control-group row mt-2">
                                <label for="" class="col-sm-3">Apellidos paterno</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="Apellido paterno" class="form-control form-control-sm" v-model="datouser.apellido_pat">
                                </div>
                            </div>
                            <div class="control-group row mt-2">
                                <label for="" class="col-sm-3">Apellidos materno</label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="Apellido materno" class="form-control form-control-sm" v-model="datouser.apellido_mat">
                                </div>
                            </div>
                            <div class="control-group row mt-2">
                                <label for="" class="col-sm-3">Sexo</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm" v-model="datouser.sexo">
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMENINO">Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group row">
                                <label for="" class="col-sm-3">Fecha Nac.</label>
                                <div class="col-sm-9">
                                    <input type="date" placeholder="Edad" class="form-control form-control-sm" v-model="datouser.fecha_nac"></div>
                            </div>
                            <div class="control-group row">
                                <label for="" class="col-sm-3">Dirección</label>
                                <div class="col-sm-9"><input type="text" placeholder="Dirección" class="form-control form-control-sm" v-model="datouser.direccion"></div>
                            </div>
                            <div class="control-group row">
                                <label for="" class="col-sm-3"> Ubigeo</label>
                                <div class="col-sm-9"><input type="text" placeholder="Dirección" class="form-control form-control-sm" v-model="datouser.ubigeo"></div>
                            </div>

                            <div class="control-group row">
                                <label for="" class="col-sm-3">Teléfono</label>
                                <div class="col-sm-9"><input type="text" placeholder="Teléfono" class="form-control form-control-sm" v-model="datouser.telefono"></div>
                            </div>
                            <div class="control-group row">
                                <label for="" class="col-sm-3">Correo</label>
                                <div class="col-sm-9"><input type="mail" placeholder="Correo" class="form-control form-control-sm" v-model="datouser.correo"></div>
                            </div>
                            <div class="control-group row">
                                <label for="" class="col-sm-3">Rol</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm" v-if="is('Superadmin')" v-model="datouser.rol">
                                        <option v-for="item in roles" :value="item.id">{{item.name}}</option>
                                        
                                    </select>
                                    <select class="form-control form-control-sm" v-else>
                                        <option value="3">Paciente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center" id="foto">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click.prevent="guardaruser">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
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
    name: 'modalnewpaciente',

    data() {
        return {
            datouser: {
                dni: '',
                nombres: '',
                apellido_pat: '',
                apellido_mat: '',
                sexo: '',
                estadocivil: '',
                fecha_nac: '',
                direccion: '',
                telefono: '',
                correo: '',
                rol: '',
                foto: '',
                ubigeo: ''
            },
            roles:[],
            comprovacion: 0

        };
    },
    

    mounted() {

    },

    methods: {
        ...mapActions(['Userlogeado']),
        
        toast(texto_anuncio, icono) {

            Toast.fire({
                // title:texto_titulo,
                title: '<small><strong>' + texto_anuncio + '</strong></small>',
                icon: icono,
                // text: texto_anuncio
            });
        },
        nuevopaciente: async function () {
            $('#newpaciente').modal('show');
            this.funroles();

        },
        funroles()
        {
            var url='/rolesuser';
            axios.get(url).then(res=>{
                this.roles=res.data
            })
        },
        async buscardni() {
            if (this.datouser.dni.length == 8) {
                var url = '/reniec/' + this.datouser.dni;
                const datos = await axios.get(url);
                // console.log(datos);
                var strhtlm = '<img src="data:image/png;base64,' + datos.data.foto + '" alt="">'
                // console.log(datos.data.foto)
                $('#foto').html(strhtlm);
                this.datouser.nombres = datos.data.prenombres
                this.datouser.apellido_pat = datos.data.apPrimer
                this.datouser.apellido_mat = datos.data.apSegundo
                this.datouser.estadocivil = datos.data.estadoCivil
                this.datouser.foto = datos.data.foto
                this.datouser.direccion = datos.data.direccion
                this.datouser.ubigeo = datos.data.ubigeo
            } else {
                alert('Número de digitos ingresado no corresponde a DNI')
            }
        },
        guardaruser() {

            if (this.datouser.nombres == '') {
                this.comprovacion = 0
            }
            if (this.datouser.apellido_pat == '') {
                this.comprovacion = 0
            }
            if (this.datouser.apellido_mat == '') {
                this.comprovacion = 0
            }
            if (this.datouser.estadocivil == '') {
                this.comprovacion = 0
            }
            if (this.datouser.direccion == '') {
                this.comprovacion = 0
            }
            if (this.datouser.ubigeo == '') {
                this.comprovacion = 0
            }
            if (this.datouser.telefono == '') {
                this.comprovacion = 0
            }
            if (this.datouser.correo == '') {
                this.comprovacion = 0
            }
            if (this.datouser.rol == '') {
                this.comprovacion = 0
            }
            if (this.datouser.sexo == '') {
                this.comprovacion = 0
            }
            if (this.datouser.fecha_nac == '') {
                this.comprovacion = 0
            }
            else{
                this.comprovacion = 1 
            }
            if (this.comprovacion == 0) {
                this.toast('Algunos datos faltan para guardar','warning')
            }
            else{
                
                // var url='/newuser'

                // axios.post(url,this.datouser).then(res=>{
                //     // console.log(res.data)
                //     this.toast('Se guardó el usuario de forma exitosa','success');
                //     $('#newpaciente').modal('hide');
                // })
                this.$store.dispatch('addusers', this.datouser); 
                this.toast('Se guardó el usuario de forma exitosa','success');
                $('#newpaciente').modal('hide');
                this.$emit('listadouser')
                
            }
        }
    },
};
</script>

<style lang="scss" scoped>

</style>
