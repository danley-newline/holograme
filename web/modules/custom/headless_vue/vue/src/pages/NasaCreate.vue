<template>
  <div class="container UserPage">
      <div class="text-center">
          <h5>Espace Nasa creation</h5>
      </div>
      <button class="btn btn-danger" @click="createNasa">send </button>
      <form action="" @submit.prevent="createNasa">
        <div class="form-group">
          <label for="">title</label>
          <input type="text" class="form-control" name="name" required v-model="nasaInfo.title">
        </div>
        <div class="form-group">
          <label for="">body</label>
          <input type="text" class="form-control" name="name" required v-model="nasaInfo.body">
        </div>
        

        <button type="submit" class="btn btn-success">Soumettre</button>
      </form>
  </div>
</template>

<script>
import axios, { getUrl, headers } from '../services/index'
export default {
  data(){
    return{
      nasaInfo:{
        title:"",
        body:"",
      }
      
    }
  },
  http:{
    headers:{
      'Accept': "json",
      "Content-Type": "application/vnd.api+json",
      'Authorization': 'Basic YWRtaW46YWRtaW4='
    }
  }
  ,
  methods:{
    async createNasa(){
      console.log("INfo saisit ", this.nasaInfo)
      var data = {
          "_links":{
            "type": {
              "href": "http://holograme.td/rest/type/node/nasa"
            }
          },
          "title":[
            {
              "value": this.nasaInfo.title
            }
          ],
          "body":[
            {
              "value": this.nasaInfo.body
            }
          ]
      }

      // axios.post("/node?_format=hal_json", data, headers,function(response) {

      // });
      this.$http.post("http://holograme.td/node?_format=hal_json", data)
      
            
    }
  },
 
  
}
</script>

<style>

</style>