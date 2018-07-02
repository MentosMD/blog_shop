import Vue from 'vue';
import VueRouter from 'vue-router';

import  MainPage  from '../components/MainPage.vue';
import  OrdersPage  from '../components/OrdersPage.vue';
import AddBookForm from '../components/forms/AddBookForm.vue'
import EditBookForm from '../components/forms/EditBookForm.vue'
import OrderDetail from '../components/OrderDetail.vue'
import BookDetail from '../components/BookDetail.vue'

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', mode: 'history', name: 'main', component: MainPage },
        { path: '/admin/orders', mode: 'history', name: 'orders', component: OrdersPage },
        { path: '/admin/order/detail/:id', mode: 'history', name: 'order_detail', component: OrderDetail },
        { path: '/admin/book/add', mode: 'history', name: 'add_book', component: AddBookForm },
        { path: '/admin/book/edit/:id', mode: 'history', name: 'edit_book', component: EditBookForm },
        { path: '/admin/book/detail/:id', mode: 'history', name: 'detail_book', component: BookDetail }
    ]
})