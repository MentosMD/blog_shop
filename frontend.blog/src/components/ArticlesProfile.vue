<template>
    <div class="row">
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
        <div class="row">
            <a href="#/profile/blog/add">Add new article</a>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import * as config from '../config';
    export default {
        props: {
           blogs: {type: Array},
           ratings: {type: Array}
        },
        data() {
            return {
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
        methods: {
            notify(text, type){
                this.$notify({
                    group: 'example',
                    text: text,
                    type: type
                });
            },
            onFiltered (filteredItems) {
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            },
            deleteBlog(id) {
                let conf = confirm('Are you really want to delete this blog?');
                if (conf) {
                    axios.get(config.API_PROFILE_BLOG_DELETE + id)
                        .then(data => {
                            this.notify('Successfully deleted', 'success');
                            setTimeout(() => {
                                location.replace('#/profile');
                            },1500);
                        })
                        .catch(err => {});
                }
            }
        }

    }
</script>

<style scoped>

</style>