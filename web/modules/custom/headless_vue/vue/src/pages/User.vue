<template>
  <div class="container UserPage">
      <div class="text-center">
          <h5>Espace Utilisateur</h5>
      </div>
      <form action="" @submit.prevent="createUser">
        <div class="form-group">
          <label for="">Username</label>
          <input type="text" class="form-control" name="name" required v-model="infoUser.name">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="email" class="form-control" name="email" required v-model="infoUser.email">
        </div>
        <div class="form-group">
          <label for="">Mot de passe</label>
          <input type="password" class="form-control" name="password" required v-model="infoUser.password">
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
      infoUser:{
        name:"",
        email:"",
        password:""
      }
      
    }
  },
  methods:{
    async createUser(){
      console.log("INfo saisit ", this.infoUser)
      var data = {
          "_links":{
            "type": {
              "href": "http://holograme.td/rest/type/user/user"
            }
          },
          "name":[
            {
              "value": this.name
            }
          ],
          "mail":[
            {
              "value": this.email
            }
          ],
          "pass":[
            {
              "value": this.password
            }
          ],
          
      }

      axios.post("/user/register?_format=json", {
          headers: {
              'Accept': "json",
              "Content-Type": "application/json",
              // 'Authorization': 'Basic YWRtaW46YWRtaW4=',
              "X-CSRF-Token": "r30pDmg0L5hq7n8gO_Qj7Zd8XFGAV8a9rQ4d3tA7FFI"
          },
          data
        });
      
            
    }
  }
}
</script>

<style>

</style>