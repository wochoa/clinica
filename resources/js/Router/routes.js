import Vue from 'vue';
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Router from 'vue-router';

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'

Vue.use(LaravelPermissionToVueJS)
Vue.use(ElementUI);

Vue.use(Router);
// Import Bootstrap and BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
// Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
// Vue.use(IconsPlugin)


import Paginaini  from '../components/Paginainicio/index.vue';
import Dashboard  from '../components/Dashboard/index.vue';
import Datospacientes  from '../components/Datospacientes/index.vue';
import Cirujano  from '../components/Cirujano/index.vue';
import Citas  from '../components/Citas/index.vue';
import Nuevacita  from '../components/Citas/Nuevacita.vue';
import Calendariocitas  from '../components/Citas/Calendariocitas.vue';
import Tratamiento  from '../components/Tratamientos/index.vue';
import Newtratamiento  from '../components/Tratamientos/nuevo.vue';
import Atenciontratamiento  from '../components/Tratamientos/Tratamientopaciente.vue';
import Historial  from '../components/Tratamientos/Historial.vue';
import Gastos  from '../components/Gastos/index.vue';
import Cajadiaria  from '../components/Cajadiaria/index.vue';
/////////// ADMINISTRACION //////////////////
import Usuarios  from '../components/Administracion/usuarios/index.vue';
import Editusuarios  from '../components/Administracion/usuarios/editar.vue';
import Rolypermiso  from '../components/Administracion/usuarios/index.vue';

export default new Router({
    mode: 'history',
    routes:[

        {   path:'/',
            name:'inicio',
            component:Paginaini 
        },

        // {   path:'/',
        //     name:'principal',
        //     component:Dashboard 
        // },
        {   path:'/home',
            name:'Dashboard',
            component:Dashboard 
        },
        {   path:'/pacientes',
            name:'Pacientes',
            component:Datospacientes 
        },
        {   path:'/cirujano',
            name:'Cirujano Dentista',
            component:Cirujano 
        },
        {   path:'/citas',
            name:'Citas',
            component:Citas 
        },
        {   path:'/citas/nuevacita',
            name:'Nueva Cita',
            component:Nuevacita 
        },
        {   path:'/citas/calendariocitas',
            name:'Calendario citas',
            component:Calendariocitas 
        },
        {   path:'/tratamientos',
            name:'Tratamientos',
            component:Tratamiento 
        },
        {   path:'/tratamientos/nuevo-tratamientos',
            name:'Nuevo paciente y su tratamiento',
            component:Newtratamiento 
        },
        {   path:'/tratamientos/tratamiento-paciente/:idpaciente/:idcitas',
            name:'Atención tratamiento',
            component:Atenciontratamiento 
        },
        {   path:'/tratamientos/:id/historial',
            name:'Historial de tratamiento',
            component:Historial 
        },
        {   path:'/gastos',
            name:'Gastos',
            component:Gastos 
        },
        {   path:'/cajadiaria',
            name:'Caja diaria',
            component:Cajadiaria 
        },
        {   path:'/Administracion/usuarios',
            name:'Administración de usuarios',
            component:Usuarios 
        },
        {   path:'/Administracion/usuarios/:id/edit',
            name:'Editar usuario',
            component:Editusuarios 
        },
        {   path:'/Administracion/rolesypermisos',
            name:'Roles y permisos',
            component:Rolypermiso 
        },



    ],
    linkActiveClass:'active'
})