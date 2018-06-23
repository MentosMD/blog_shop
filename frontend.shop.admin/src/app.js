import Vue from 'vue'
import VueRouter from 'vue-router';
import VueBootstrapTable from 'vue-bootstrap-table2';
import Notifications from 'vue-notification';

import App from './App.vue'
import './assets/app.styl'

import router from './router/index.js'

Vue.use(VueBootstrapTable);
Vue.use(Notifications);

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})