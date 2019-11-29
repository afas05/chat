import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import BootstrapVue from "bootstrap-vue";
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import VueEcho from 'vue-echo-laravel';

window.io = require('socket.io-client');

Vue.config.productionTip = false;
Vue.use(BootstrapVue);

Vue.use(VueEcho, {
    broadcaster: 'socket.io',
    host: 'localhost:6001',
    auth: {
        headers: {
            Authorization: 'Bearer ' + localStorage.token
        }
    }
});

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
