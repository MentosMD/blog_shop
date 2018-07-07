<template>
    <div class="row">
        <v-head></v-head>
        <div class="container">
            <b-table striped hover
                     :items="orders"
                     :fields="fields">
                <template slot="Detail" slot-scope="data">
                    <router-link title="Detail" v-bind:to="`order/detail/${data.item.OrderId}`" class="btn btn-outline-primary">
                        <i class="fas fa-eye"></i>
                    </router-link>
                </template>
            </b-table>
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
              orders: [],
              fields: [
                  {
                      key: 'OrderId',
                      label: 'ID'
                  },
                  {
                      key: 'name',
                      label: 'Name'
                  },
                  {
                      key: 'email',
                      label: 'Email'
                  },
                  {
                      key: 'phone',
                      label: 'Phone'
                  },
                  {
                      key: 'city',
                      label: 'City'
                  },
                  {
                      key: 'address',
                      label: 'Address'
                  },
                  {
                      key: 'Detail',
                      label: ''
                  }
              ]
          }
        },
        mounted(){
            axios.get(config.API_ADMIN_ORDERS)
                .then((data) => {
                    this.orders = data.data.response;
                }).catch((err) => {
                    console.log(err);
                });
        }
    }
</script>

<style scoped>

</style>