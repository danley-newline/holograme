<template>
  <div >
      <div class="text-center">
        </div>
      <div class="container border-lg mt-4">
          <div class="row">
              <div class="col-md-6" v-for="(history, id) in historyBlock" :key="id">
                  <div class="row card-history">
                      <div class="col-md-8">
                        <h5 v-html="history.title[0].value"></h5>
                        <p v-html="history.body[0].value"></p>
                        <p>Crée le <span v-html="history.field_date_histoire[0].value"></span></p>
                      </div>
                      <div class="col-md-4">
                          <img :src="history.field_image_histoire[0].url" alt="" class="w-100">
                      </div>
                      <div class="text-center">
                        <button class="w-75 btn btn-warning" @click="goHistoryOne(history)">PLus d'info</button>
                        </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import axios from '../services/index'

import TitreHome from "../components/TitreHome.vue"
export default {
    data(){
        return{
            historyBlock:[],
            dabali:[]
        }
    },
    methods:{
        danger(){
            console.log("clické")
                
        },
        goHistoryOne(e){
            this.$store.commit("historyOneInfo",e);
            this.$router.push({name: 'one-like'});
        }
    },
    
  mounted() {
    axios
      .get("/api/histoire?_format=json")
      .then((res) => res.data)
      .then((res) => {
        // res.length = 5;
        this.historyBlock = res;
        console.log("sALUT Likepage historyBlock", this.historyBlock);
      });


  },
    components:{
        TitreHome,
    }
}
</script>

<style>

</style>