import Vue from 'vue';
import VueRouter from 'vue-router';

import  MainPage  from '../components/MainPage.vue';
import AddBlog from '../components/forms/AddBlog.vue';
import EditBlog from '../components/forms/EditBlog.vue';
import CommentsPage from '../components/CommentsPage.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', mode: 'history', name: 'main', component: MainPage },
        { path: '/admin/comments', mode: 'history', name: 'comments', component: CommentsPage },
        { path: '/admin/blog/add', mode: 'history', name: 'add-blog', component: AddBlog },
        { path: '/admin/blog/update/:id', mode: 'history', name: 'update-blog', component: EditBlog },
    ]
})