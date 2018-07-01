<template>
    <div class="row">
        <div class="container">
            <b-table striped hover
                     :items="books"
                     :fields="fields">
                <template slot="Delete" slot-scope="data">
                    <button class="btn btn-outline-danger" @click="deleteBook(data.item.id)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </template>
                <template slot="Edit" slot-scope="data">
                    <router-link v-bind:to="`admin/book/edit/${data.item.id}`" class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></router-link>
                </template>
            </b-table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import * as config from '../config'
    import VueBootstrapTable from 'vue2-bootstrap-table2'
    export default {
        components:{
            'vue-bootstrap-table': VueBootstrapTable
        },
        data(){
            return{
                books: [],
                fields: [
                    {
                        key: 'title',
                        label: 'Title'
                    },
                    {
                        key: 'author',
                        label: 'Author'
                    },
                    {
                        key: 'pages',
                        label: 'Pages'
                    },
                    {
                        key: 'price',
                        label: 'Price'
                    },
                    {
                        key: 'Delete',
                        label: ''
                    },
                    {
                        key: 'Edit',
                        label: ''
                    },
                ]
            }
        },
        mounted(){
            axios.get(config.API_ADMIN_BOOKS)
                .then((data) => {
                    this.books = data.data.response;
                }).catch((err) => {
                   console.log(err);
                })
        },
        methods: {
            deleteBook(id)
            {
                console.log(id);
            }
        }
    }
</script>

<style scoped>

</style>