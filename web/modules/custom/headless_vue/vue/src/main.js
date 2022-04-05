import Vue from 'vue'
import App from './App.vue'
import router from './routes'
import store from "./store";
import "./plugins"
import VueResource from 'vue-resource';

Vue.use(VueResource);


Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
