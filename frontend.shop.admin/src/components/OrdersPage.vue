<template>
    <div class="row">
        <v-head></v-head>
        <div class="container">
            <h2>Orders</h2>
        </div>
    </div>
</template>

<script>
    import Head from './Head.vue'
    import axios from 'axios'
    import * as config from '../config'
    export default {
        components: {
            'v-head': Head
        },
        data(){
          return {
              orders: []
          }
        },
        mounted(){
            axios.get(config.API_ADMIN_ORDERS)
                .then((data) => {
                    this.orders = data.data.response;
                    console.log(this.orders);
                }).catch((err) => {
                    console.log(err);
                });
        }
    }
</script>

<style scoped>

</style>