import Vue from 'vue';
import VueRouter from 'vue-router';

import  MainPage  from '../components/MainPage.vue';
import PrayerPage from '../components/PrayerPage.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', mode: 'history', name: 'main', component: MainPage },
        { path: '/prayers', mode: 'history', name: 'prayer', component: PrayerPage },
    ]
})