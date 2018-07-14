<template>
    <div class="row">
        <div class="container">
            <b-table striped hover
                     :items="books"
                     :fields="fields"
                     :current-page="currentPage"
                     :per-page="perPage"
                     :filter="filter"
                     @filtered="onFiltered"
            >
                <template slot="Image" slot-scope="data">
                    <img :src="require(`../assets/images/${data.item.image}`)" width="50" height="50" />
                </template>
                <template slot="Delete" slot-scope="data">
                    <button class="btn btn-outline-danger" @click="deleteBook(data.item.id)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </template>
                <template slot="Edit" slot-scope="data">
                    <router-link v-bind:to="`admin/book/edit/${data.item.id}`" class="btn btn-outline-primary"><i class="fas fa-pencil-alt"></i></router-link>
                </template>
                <template slot="Detail" slot-scope="data">
                    <router-link title="Detail" v-bind:to="`admin/book/detail/${data.item.id}`" class="btn btn-outline-primary"><i class="fas fa-eye"></i></router-link>
                </template>
            </b-table>
            <div class="row" style="display: flex; justify-content: flex-end">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="" />
            </div>
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
                filter: null,
                currentPage: 1,
                perPage: 5,
                totalRows: 0,
                fields: [
                    {
                        key: 'Image',
                        label: ''
                    },
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
                        label: 'Price $'
                    },
                    {
                        key: 'Delete',
                        label: ''
                    },
                    {
                        key: 'Edit',
                        label: ''
                    },
                    {
                        key: 'Detail',
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
            notify(text, type){
                this.$notify({
                    group: 'example',
                    text: text,
                    type: type
                });
            },
            deleteBook(id)
            {
                axios.get(config.API_ADMIN_BOOK_DELETE + id)
                    .then((data) => {
                        this.notify('Successfully deleted!', 'success');
                        setTimeout(() => {
                            location.replace('/');
                        }, 1000);
                    }).catch((err) => {

                });
            },
            onFiltered (filteredItems) {
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            }
        }
    }
</script>

<style scoped>

</style>