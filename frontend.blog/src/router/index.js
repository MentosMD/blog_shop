import Vue from 'vue';
import VueRouter from 'vue-router';

import  MainPage  from '../components/MainPage.vue';
import PrayerPage from '../components/PrayerPage.vue';
import BlogDetail from '../components/BlogDetail.vue';
import RegisterPage from '../components/forms/RegisterPage.vue';
import LoginPage from '../components/forms/LoginPage.vue';
import ProfilePage from '../components/ProfilePage.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', mode: 'history', name: 'main', component: MainPage },
        { path: '/prayers', mode: 'history', name: 'prayer', component: PrayerPage },
        { path: '/blog/detail/:id', mode: 'history', name: 'blog_detail', component: BlogDetail },
        { path: '/user/register', mode: 'history', name: 'register', component: RegisterPage },
        { path: '/user/login', mode: 'history', name: 'login', component: LoginPage },
        { path: '/profile', mode: 'history', name: 'profile', component: ProfilePage },
    ]
})