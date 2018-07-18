import Vue from 'vue';
import VueRouter from 'vue-router';

import  MainPage  from '../components/MainPage.vue';
import PrayerPage from '../components/PrayerPage.vue';
import CategoriesPage from '../components/CategoriesPage.vue';
import BlogDetail from '../components/BlogDetail.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', mode: 'history', name: 'main', component: MainPage },
        { path: '/prayers', mode: 'history', name: 'prayer', component: PrayerPage },
        { path: '/categories', mode: 'history', name: 'category', component: CategoriesPage },
        { path: '/blog/detail/{id}', mode: 'history', name: 'blog_detail', component: BlogDetail },
    ]
})