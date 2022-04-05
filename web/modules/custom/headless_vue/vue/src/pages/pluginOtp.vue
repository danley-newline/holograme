<template>
  <div>
      <div class="container">

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
                 <v-otp-input
                    inputClasses="otp-input"
                    :numInputs="4"
                    separator="-"
                    :shouldAutoFocus="true"
                    @on-complete="handleOnComplete"
                    @on-change="handleOnChange"
                    />
            </div>

            
            <div class="link-after-input my-3">
            <a href="#!" class="text-muted ">Je n'ai pas reçu le code de confirmation</a>
            <div class="d-flex justify-content-between sendmail my-2">
                <a href="" class="text-muted new-otp">
                <span><img src="/modules/custom/headless_vuejs/vue/src/assets/images/device-smart-phone.png" class="mr-2" alt=""></span> Renvoyez le
                code par SMS </a>
                <!--p class="text-muted mb-2">59 s</p-->
            </div>
            </div>
        </div>

     </div>
  </div>
</template>

<script>
import OtpInput from "@bachdgvn/vue-otp-input";

export default {
    data(){
        return{
        }
    },
    components:{
        "v-otp-input": OtpInput,
    },
    
    methods:{
        handleOnComplete(value) {
            console.log("Valeur final OTP: ", value);
        },
        handleOnChange(value) {
        console.log("OTP: ", value);
        }
    }
}
</script>

<style>


.home-form a, .home-form a:hover{
    text-decoration: none ;
}
.home-form a:hover{
    color: #f16e00 !important;
}
.home-form {
    width: 50%;
    border: 2px solid #cccccc;
    background-color: #fff;
    position: relative;
    padding: 5rem;

}
.sendmail{
    border-bottom: 1px solid #cccccc;
}
.icon-form {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%,-50%);
}
.userInputotp{
    display: flex;
    justify-content: center;
}
form#otp-form {
    display: flex;
}
.userInputotp input{
    height: 50px;
    width: 75px;
    border:2px solid #666666;
    
    margin: 1rem;
    font-weight: bold;
    text-align: center;
}

</style>