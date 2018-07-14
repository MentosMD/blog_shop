<template>
    <div class="row">
        <v-head></v-head>
        <b-modal ref="ModalRef" hide-footer :title="order.name">
            <div class="d-block text-center">
                <div class="row order-block margin-top-15" v-for="cart in carts">
                     <img :src="require(`../assets/images/${cart.image}`)" width="100" height="100"/>
                     <h4 class="order-block-title text-info">{{ cart.title }}</h4>
                     <span class="order-block-price">{{ cart.price }}$</span>
                </div>
            </div>
            <b-btn class="mt-3" variant="outline-danger" block @click="hideModal">Close Me</b-btn>
        </b-modal>
        <div class="container text-align-center padd-top-55">
            <h3 class="text-info txt">ID: {{ this.order.OrderId }}</h3>
            <h3 class="text-info txt">Name: {{ this.order.name }}</h3>
            <h3 class="text-info txt">OrderDate: {{ this.order.OrderDate }}</h3>
            <h3 class="text-info txt">Quantity: {{ this.order.OrderQuantity }}</h3>
            <h3 class="text-info txt">Total: {{ this.order.OrderTotal }}$</h3>
            <h3 class="text-info txt">City: {{ this.order.city }}</h3>
            <h3 class="text-info txt">Address: {{ this.order.address }}</h3>
            <h3 class="text-info txt">Phone: {{ this.order.phone }}</h3>
            <h3 class="text-info txt">Email: {{ this.order.email }}</h3>
            <button class="btn btn-outline-success" @click="showModal">Orders</button>
            <button class="btn btn-outline-danger" @click="deleteOrder">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import * as config from '../config'
    import Head from './Head.vue'
    export default {
        components: {
           'v-head': Head
        },
        data(){
            return{
                id: this.$route.params.id,
                order: {},
                carts: []
            }
        },
        mounted(){
            axios.get(config.API_ADMIN_GET_ORDER + this.id)
                .then((data) => {
                    this.order = data.data.response[0];
                    this.carts = JSON.parse(data.data.response[0].cart);
                }).catch((err) => {
                   console.log(err);
            });
        },
        methods: {
            notify(text, type){
                this.$notify({
                    group: 'example',
                    text: text,
                    type: type
                });
            },
            hideModal () {
                this.$refs.ModalRef.hide();
            },
            showModal () {
                this.$refs.ModalRef.show();
            },
            deleteOrder(){
                axios.get(config.API_ADMIN_DELETE_ORDER + this.order.OrderId)
                    .then((data) => {
                        this.notify('Successfully deleted!', 'error');
                        location.replace('#/admin/orders');
                    })
                    .catch((err) => {});
            }
        }
    }
</script>

<style lang="stylus" scoped>
    .order-block-title
         font-size 18px
    .order-block-price
        font-size 17px
        font-family sans-serif
    .txt
        font-size 19px
</style>