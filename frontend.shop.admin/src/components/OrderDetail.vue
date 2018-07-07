<template>
    <div class="row">
        <v-head></v-head>
        <b-modal ref="ModalRef" hide-footer :title="order.name">
            <div class="d-block text-center">
                <div class="row order-block margin-top-15" v-for="cart in carts">
                     <img :src="`../assets/images/${cart.image}`" width="50" height="50"/>
                     <h4>{{ cart.title }}</h4>
                </div>
            </div>
            <b-btn class="mt-3" variant="outline-danger" block @click="hideModal">Close Me</b-btn>
        </b-modal>
        <div class="container text-align-center padd-top-55">
            <h3>ID: {{ this.order.OrderId }}</h3>
            <h3>Name: {{ this.order.name }}</h3>
            <h3>OrderDate: {{ this.order.OrderDate }}</h3>
            <h3>Quantity: {{ this.order.OrderQuantity }}</h3>
            <h3>Total: {{ this.order.OrderTotal }}$</h3>
            <h3>City: {{ this.order.city }}</h3>
            <h3>Address: {{ this.order.address }}</h3>
            <h3>Phone: {{ this.order.phone }}</h3>
            <h3>Email: {{ this.order.email }}</h3>
            <button class="btn btn-outline-success" @click="showModal">Orders</button>
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
            hideModal () {
                this.$refs.ModalRef.hide();
            },
            showModal () {
                this.$refs.ModalRef.show();
            },
        }
    }
</script>

<style scoped>

</style>