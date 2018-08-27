<template>
     <div class="row">
         <div class="container">
             <b-table striped hover
                      :items="blogs"
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
             <div class="row" style="display: flex; justify-content: flex-end">
                 <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="" />
             </div>
         </div>
     </div>
</template>

<script>
    import axios from 'axios';
    import * as config from '../config';
    export default {
        data() {
            return {
                blogs: [],
                filter: null,
                currentPage: 1,
                perPage: 5,
                totalRows: 0,
                fields: [
                    {
                        key: 'blog_title',
                        label: 'Title'
                    },
                    {
                        key: 'blog_author',
                        label: 'Author'
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
            axios.get(config.API_ADMIN_BLOG_ALL)
                .then(data => { this.blogs = data.data.response; })
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