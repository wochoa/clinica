<template>
 <div>
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $route.name }} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link :to="'/'">Dashboard</router-link></li>
              <li class="breadcrumb-item"><router-link :to="'/Administracion/usuarios'">Usuarios</router-link></li>
              <li class="breadcrumb-item active">{{ $route.name }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            
                <!-- <router-link  class="btn btn-info btn-sm" @click="router.go(-1)"><i class="fa-regular fa-circle-left"></i> Volver</router-link> -->
                <button class="btn btn-info btn-sm btn-block" @click="retroceder()"><i class="fa-regular fa-circle-left"></i> Volver</button>
            

            <!-- Profile Image -->
            <div class="card card-primary card-outline mt-2">
              <div class="card-body box-profile">
                <div class="text-center" id="foto">
                  <!-- <img class="profile-user-img img-fluid img-circle" :src="ruta+'/dist/img/user4-128x128.jpg'" alt="User profile picture"> -->
                </div>

                <h4 class="profile-username text-center">{{filluser.nombre}} {{filluser.apellidos}}</h4>

                <!-- <p class="text-muted text-center">{{filluser.cargo}}</p> -->

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Correo</b> <a class="float-right">{{filluser.correo}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Celular</b> <a class="float-right">{{filluser.celular}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>DNI</b> <a class="float-right">{{filluser.dni}}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block" ><b>Actualizar avatar</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  
                  <!-- <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Linea de tiempo</a></li> -->
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Configuración</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                
                  <!-- /.tab-pane -->

                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName" placeholder="Name" v-model="filluser.nombre">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Apellidos</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName" placeholder="Apellidos" v-model="filluser.apellidos">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control form-control-sm" id="inputEmail" placeholder="Email" v-model="filluser.correo">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Direccion</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName2" placeholder="Name" v-model="filluser.direccion">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">DNI</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName2" placeholder="Name" v-model="filluser.dni">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Número celular</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" id="inputName2" placeholder="Name" v-model="filluser.celular">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Rol asignado</label>
                        <div class="col-sm-10">
                         <select class="form-control form-control-sm">
                          <option value="1">Super Administrador</option>
                          <option value="2">Cirujano Dentista</option>
                          <option value="3">Paciente</option>
                         </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Contraseña</label>
                        <div class="col-sm-5">
                          <input type="password" class="form-control form-control-sm" id="inputName2" placeholder="Nueva contraseña" v-model="filluser.contrasena">
                        </div>
                        <div class="col-sm-5">
                          <input type="password" class="form-control form-control-sm" id="inputName2" placeholder="Nuevamente digite la contraseña" v-model="filluser.contrasena">
                        </div>
                      </div>

                      
                      
                      
                      
                      <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Actualizar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
 </div>
</template>

<script>
 export default {
   props:['ruta'],
   name: '',
   data () {
     return {
         filluser:{
             iduser:null,
             nombre:'',
             apellidos:'',
             iniciales:'',
             fechanac:'',
             contrasena:'',
             estadocivil:'',
             correo:'',
             dni:'',
             direccion:'',
             fechavigencia:'',
             telefono:'',
             celular:'',
             avatar:'',

         },
         datosuser:[]
         

     }
   },
   components: {

   },
   
   mounted () {
       this.getusuarios();
       
   },
   methods: {
       getusuarios(){
           var url='/listauser/'+this.$route.params.id;
           axios.get(url)
                .then((result) => {
                    this.datosuser = result.data

                    /// asignamos los datos a las variables
                  this.filluser.iduser=this.datosuser[0].id;
                  this.filluser.nombre=this.datosuser[0].nombre;
                  this.filluser.apellidos=this.datosuser[0].ap_paterno+' '+this.datosuser[0].ap_materno;
                  this.filluser.estadocivil=this.datosuser[0].estadocivil;
                  this.filluser.fechanac=this.datosuser[0].fecha_nac;
                  this.filluser.correo=this.datosuser[0].email;
                  this.filluser.dni=this.datosuser[0].num_doc;
                  this.filluser.direccion=this.datosuser[0].direccion;
                  this.filluser.celular=this.datosuser[0].celular;
                  this.filluser.telefono=this.datosuser[0].telefono;
                  this.filluser.avatar=this.datosuser[0].foto;
                  
                  var strhtlm = '<img class="profile-user-img img-fluid img-circle" src="data:image/png;base64,' + this.filluser.avatar + '" alt="User profile picture">'
                  // <img class="profile-user-img img-fluid img-circle" :src="ruta+'/dist/img/user4-128x128.jpg'" alt="User profile picture">
                  $('#foto').html(strhtlm);

                });
       },

       retroceder(){
                      window.history.back();
                    }

   }
 }
</script>

<style lang="css" scoped>

</style>
