import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);
const debug = process.env.NODE_ENV !== 'production'

const store = new Vuex.Store({
  state: {

    usuarios:[]

  },
  mutations: {
    USUARIOS(state,datosuser){
        state.usuarios=datosuser
    },
    DELETE_USUARIOS(state, idvalue) {
    const index = state.usuarios.data.findIndex(iduser => iduser.id === idvalue); 
    state.usuarios.data.splice(index, 1); 
  }
  },
  actions:{
    async getUsuarios({commit},page)
    {   var url='/listauser?page='+page
        await axios.get(url)
        .then(resp=>{
            commit('USUARIOS',resp.data)
        })
        
    },
    async addusers({commit},values){
      axios.post('/newuser',values).then(res=>{
        commit('USUARIOS',res.data)
      
    })
    },
    deleteUser({commit},values){
      axios.delete('/borraruser/'+values).then(res=>{
        commit('DELETE_USUARIOS',res.data)
      })
    }
    

  },
  getters:{
    Listauser(state)
    {
        return state.usuarios;
    }



  },
  modules:{

  }
})

export default store;