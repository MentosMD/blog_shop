<template>
    <div class="row">
        <div class="container padd-20">
            <div class="col-md-5">
                <form method="post" action="#">
                    <div class="col-md-11 float-left">
                        <b-form-input v-model="search"
                                      type="text"
                                      placeholder="Search..."
                                      required></b-form-input>
                    </div>
                    <div class="col-md-1 float-right">
                        <button type="button" @click="onSubmit" class="btn btn-outline-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="row" v-for="blog in paginatedBlogs">
                <blog-item
                        :id="blog.id"
                        :title="blog.blog_title"
                        :author="blog.blog_author"
                        :date="blog.created_date">
                </blog-item>
            </div>
            <ul class="pagination paginate margin-top-30">
                <button type="button" @click="prevPage" class="btn btn-outline-primary prev">Prev</button>
                <li v-for="pageNumber in totalPages"
                    v-if="Math.abs(pageNumber - currentPage) < 3 || pageNumber == totalPages - 1 || pageNumber == 0">
                    <a href="#" @click="setPage(pageNumber)"
                       :class="{current: currentPage === pageNumber, last: (pageNumber == totalPages - 1 && Math.abs(pageNumber - currentPage) > 3), first:(pageNumber == 0 && Math.abs(pageNumber - currentPage) > 3)}">
                        {{ pageNumber }}</a>
                </li>
                <button @click="nextPage" class="btn btn-outline-primary next">Next</button>
            </ul>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import BlogItem from './BlogItem.vue';
    import * as config from '../config';
    export default {
        components: {
            'blog-item': BlogItem
        },
        data() {
            return {
                blogs: [],
                search: '',
                currentPage: 1,
                itemsPerPage: 4,
                resultCount: 0,
            }
        },
        mounted(){
            axios.get(config.API_BLOG_ALL)
                .then((data) => {
                    this.blogs = data.data.response;
                })
                .catch(err => {});
        },
        methods: {
            onSubmit(e) {
                axios.post(config.API_BLOG_SEARCH, {title: this.search})
                    .then(data => {
                        this.blogs = data.data.response;
                    }).catch(err => {});
            },
            nextPage() {
                this.currentPage++;
            },
            prevPage() {
                if (this.currentPage <= 0) {
                    return null;
                } else {
                    this.currentPage--;
                }
            },
            setPage(pageNumber) {
                this.currentPage = pageNumber
            },
        },
        computed: {
            totalPages() {
                return Math.ceil(this.resultCount / this.itemsPerPage)
            },
            paginatedBlogs() {
                this.resultCount = this.blogs.length;
                if (this.currentPage >= this.totalPages) {
                    this.currentPage = Math.max(0, this.totalPages - 1);
                }
                let index = this.currentPage * this.itemsPerPage;
                return this.blogs.slice(index, index + this.itemsPerPage);
            },
        },
    }
</script>

<style lang="stylus" scoped>
     .float-left
          float left
     .float-right
          float: right
     .padd-20
         padding-top 20px
     .paginate li
         margin-left 8px
     .paginate .prev
          margin-right 15px
     .paginate .next
          margin-left 15px
     .margin-top-30
          margin-top 30px
     .current
         color: red
</style>