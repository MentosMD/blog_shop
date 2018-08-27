<template>
    <div class="row">
        <div class="container">
            <v-head></v-head>
            <b-table striped hover
                     :items="users"
                     :fields="fields"
                     :current-page="currentPage"
                     :per-page="perPage"
                     :filter="filter"
                     @filtered="onFiltered"
            >
                <template slot="Detail" slot-scope="data">
                    <router-link :to="{ name: 'user-page', params: { id: data.item.id }}">
                        <i class="fas fa-eye"></i>
                    </router-link>
                </template>
            </b-table>
            <div class="row" style="display: flex; justify-content: flex-end">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="" />
            </div>
        </div>
    </div>
</template>

<script>
    import Head from './Head.vue';
    import axios from 'axios';
    import * as config from '../config';
    export default {
        components: {
            'v-head': Head
        },
        data() {
            return {
                users: [],
                filter: null,
                currentPage: 1,
                perPage: 5,
                totalRows: 0,
                fields: [
                    {
                        key: 'firstname',
                        label: 'First name'
                    },
                    {
                        key: 'lastname',
                        label: 'Last name'
                    },
                    {
                        key: 'age',
                        label: 'Age'
                    },
                    {
                        key: 'country',
                        label: 'Country'
                    },
                    {
                        key: 'Detail',
                        label: ''
                    }
                ]
            }
        },
        mounted() {
            axios.get(config.API_ADMIN_USERS)
                .then(data => { this.users = data.data.response; })
                .catch(err => {});
        },
        methods: {
            onFiltered (filteredItems) {
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            },
            detailUser(id) {

            }
        }
    }
</script>

<style scoped>

</style>