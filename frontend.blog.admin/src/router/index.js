import Vue from 'vue';
import VueRouter from 'vue-router';

import  MainPage  from '../components/MainPage.vue';
import UsersPage from '../components/UsersPage.vue';
import UserPage from '../components/UserPage.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', mode: 'history', name: 'main', component: MainPage },
        { path: '/admin/users', mode: 'history', name: 'users', component: UsersPage },
        { path: '/admin/user/detail/:id', mode: 'history', name: 'user-page', component: UserPage },
    ]
})