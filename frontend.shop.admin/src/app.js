import Vue from 'vue'
import VueBootstrapTable from 'vue2-bootstrap-table2';
import Notifications from 'vue-notification';
import BootstrapVue from 'bootstrap-vue'
import '../node_modules/bootstrap/dist/css/bootstrap.css'
import '../node_modules/bootstrap-vue/dist/bootstrap-vue.css'

import App from './App.vue'
import './assets/app.styl'

import router from './router/index.js'

Vue.use(BootstrapVue);
Vue.use(VueBootstrapTable);
Vue.use(Notifications);

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})