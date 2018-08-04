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
    </div>
</template>

<script>
    export default {
        props: {
           blogs: {type: Array}
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
                    },
                ]
            }
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