import Vue from 'vue';
import VueRouter from 'vue-router';

import  MainPage  from '../components/MainPage.vue';
import  OrdersPage  from '../components/OrdersPage.vue';
import AddBookForm from '../components/forms/AddBookForm.vue'
import EditBookForm from '../components/forms/EditBookForm.vue'

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', mode: 'history', name: 'main', component: MainPage },
        { path: '/admin/orders', mode: 'history', name: 'orders', component: OrdersPage },
        { path: '/admin/book/add', mode: 'history', name: 'add_book', component: AddBookForm },
        { path: '/admin/book/edit', mode: 'history', name: 'edit_book', component: EditBookForm }
    ]
})