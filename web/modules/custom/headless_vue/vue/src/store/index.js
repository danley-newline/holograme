import Vue from 'vue'
import Vuex from 'vuex'
import axios from '../services/index'
import createPersistedState from "vuex-persistedstate";


Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [createPersistedState()],
    state:{
        historyOnePage:{},
        nasaContent: []
    }, 
    mutations:{
        historyOneInfo(state, e){
            state.historyOnePage = e;
            //console.log("editons  dataGo:", state.historyOnePage)
        },
        MutNasaContent(state, payload){
            state.nasaContent = payload;
            console.log("editons  nasa content:", state.nasaContent)
        }
    },
    actions:{
        async LoadNasaContent({commit}) {
            axios.get("/nasa?_format=json")
                 .then(res => {
                     console.log("retoir res ", res.data)
                     commit("MutNasaContent", res.data)
                 })

        }
    }
})