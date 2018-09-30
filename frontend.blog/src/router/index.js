import Vue from 'vue';
import VueRouter from 'vue-router';

import  MainPage  from '../components/MainPage.vue';
import BlogDetail from '../components/BlogDetail.vue';
import RegisterPage from '../components/forms/RegisterPage.vue';
import LoginPage from '../components/forms/LoginPage.vue';
import ProfilePage from '../components/ProfilePage.vue';
import AddBlogUser from '../components/forms/AddBlogUser.vue';
import UserDetail from '../components/UserDetail.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', mode: 'history', name: 'main', component: MainPage },
        { path: '/blog/detail/:id', mode: 'history', name: 'blog_detail', component: BlogDetail },
        { path: '/user/register', mode: 'history', name: 'register', component: RegisterPage },
        { path: '/user/login', mode: 'history', name: 'login', component: LoginPage },
        { path: '/profile', mode: 'history', name: 'profile', component: ProfilePage },
        { path: '/profile/blog/add', mode: 'history', name: 'add_blog_user', component: AddBlogUser },
        { path: '/user/detail/:id', mode: 'history', name: 'user_detail', component: UserDetail },
    ]
})