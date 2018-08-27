<template>
    <div class="row">
        <v-head></v-head>
        <div class="container padd-top-55">
            <h4 class="text-center">{{ profile.firstname }}&nbsp;{{ profile.lastname }}</h4>
            <div class="col-md-3 offset-md-4">
                <h5>Age: <i>{{profile.age}}</i></h5>
                <h5>About me: </h5><i>{{profile.about}}</i>
                <h5>Country: <i>{{profile.country}}</i></h5>
                <h5>Count of articles: <i>{{blogs.length}}</i></h5>
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
    import * as config from '../config';
    import Head from './Head.vue';
    import BlogItem from './BlogItem.vue';
    export default {
        components: {
            'v-head': Head,
            'blog-item': BlogItem
        },
        data() {
            return {
                profile: {},
                blogs: [],
                currentPage: 1,
                itemsPerPage: 4,
                resultCount: 0,
            }
        },
        mounted() {
            axios(config.API_PROFILE_DETAIL + this.$route.params.id)
                .then(data => {
                    let self = this;
                    let res = data.data.response;
                    self.profile = res.profile;
                    self.blogs = res.blogs;
                })
                .catch(err => {});
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
        methods: {
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
        }
    }
</script>

<style lang="stylus" scoped>
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