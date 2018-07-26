<template>
    <div class="row">
        <div class="container padd-20">
            <div class="col-md-5">
                <div class="col-md-11 float-left">
                    <b-form-input v-model="search"
                                  type="text"
                                  placeholder="Search..."
                                  required></b-form-input>
                </div>
                <div class="col-md-1 float-right">
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <v-pagination :listData="blogs"></v-pagination>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import BlogItem from './BlogItem.vue';
    import Pagination from './Pagination.vue';
    import * as config from '../config';
    export default {
        components: {
           'blog-item': BlogItem,
            'v-pagination': Pagination
        },
        data(){
            return {
                blogs: [],
                search: ''
            }
        },
        mounted(){
            axios.get(config.API_BLOG_ALL)
                .then((data) => { this.blogs = data.data.response; })
                .catch(err => {});
        }
    }
</script>

<style lang="stylus" scoped>
     .float-left
          float left
     .float-right
          float: right
     .padd-20
         padding-top 20px
</style>