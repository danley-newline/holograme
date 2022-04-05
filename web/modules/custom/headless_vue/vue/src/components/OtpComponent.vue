<template>
  <div>
      <div class="container py-5">
        <button class="btn btn-danger" @click="danger">voir info</button>
       
  <div class="home-form mx-auto py-4">
    <div class="icon-form text-center">
      <img src="/modules/custom/headless_vuejs/vue/src/assets/images/screen-gisel.png" alt="">
    </div>
    <div class="text-center">
      <h5 class="text-muted mt-4">BICICI</h5>
    </div>
    <div class="descrip pt-3">
      <h3>Bienvenue Giselle Ouattara</h3>
      <p class="font-weight-bold text-muted">Veuillez saisir le code de confirmation envoyé à votre adresse
        <span class="text-primary">gisel***@bicici.com</span></p>
    </div>

    <div class="userInputotp">
        <form action="" id="otp-form">
            <input type="tel" maxlength="1" @keyup="onKeyup" v-model="codeOtp.case1">
            <input type="tel" maxlength="1" @keyup="onKeyup" v-model="codeOtp.case2">
            <input type="tel" maxlength="1" @keyup="onKeyup" v-model="codeOtp.case3">
            <input type="tel" maxlength="1" @keyup="onKeyup" v-model="codeOtp.case4">
        </form>
    </div>


    <div class="link-after-input my-3">
      <a href="#!" class="text-muted ">Je n'ai pas reçu le code de confirmation</a>
      <div class="d-flex justify-content-between sendmail my-2">
        <a href="" class="text-muted new-otp">
          <span><img src="/modules/custom/headless_vuejs/vue/src/assets/images/device-smart-phone.png" class="mr-2" alt=""></span> Renvoyez le
          code par SMS </a>
        <p class="text-muted mb-2">59 s</p>
      </div>
    </div>
  </div> 
</div>
  </div>
</template>

<script>
import gql from "graphql-tag";
export default {
    
    data(){
        return{

        }
    },
    
    
}
</script>

<style>

</style>