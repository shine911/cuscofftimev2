/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import BootstrapVue from 'bootstrap-vue';
import VueRouter from 'vue-router';
import router from './router';

import Notifications from 'vue-notification';
import axios from 'axios';
import VueAxios from 'vue-axios';;
import velocity from 'velocity-animate';
import store from './store/store';
import VueProgressBar from 'vue-progressbar';
import App from './App.vue';


axios.defaults.baseURL = 'http://localhost:8000/api';
const options = {
    color: '#36b9cc',
    failedColor: '#e74a3b',
    thickness: '3px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
  }
window.Vue = require('vue');
Vue.use(Notifications, {
    velocity
});

Vue.use(VueProgressBar, options)

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(BootstrapVue);

Vue.router = router;
Vue.use(require('@websanova/vue-auth'), {
    auth: require('./auth'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});
App.store = store;
App.router = Vue.router;
new Vue(App).$mount('#app');