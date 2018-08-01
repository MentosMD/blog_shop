<template>
    <div class="row">
        <div class="container">
            <v-head></v-head>
            <b-table striped hover
                     :items="comments"
                     :fields="fields"
                     :current-page="currentPage"
                     :per-page="perPage"
                     :filter="filter"
                     @filtered="onFiltered"
            >
                <template slot="Delete" slot-scope="data">
                    <button class="btn btn-outline-danger" @click="deleteBlog(data.item.id)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </template>
            </b-table>
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
                comments: [],
                filter: null,
                currentPage: 1,
                perPage: 5,
                totalRows: 0,
                fields: [
                    {
                        key: 'name',
                        label: 'Name'
                    },
                    {
                        key: 'email',
                        label: 'Email'
                    },
                    {
                        key: 'created_date',
                        label: 'Date created'
                    },
                    {
                        key: 'Delete',
                        label: ''
                    }
                ]
            }
        },
        mounted() {
            axios.get(config.API_ADMIN_COMMENTS)
                .then(data => { this.comments = data.data.response; })
                .catch(err => {});
        },
        methods: {
            onFiltered (filteredItems) {
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            },
            deleteBlog(id) {

            }
        }
    }
</script>

<style scoped>

</style>