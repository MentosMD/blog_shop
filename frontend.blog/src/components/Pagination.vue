<template>
    <div class="row padd-top-20">
        <ul class="row">
            <li class="row" v-for="p in paginatedData">
                 <v-blog
                    :id="p.id"
                    :title="p.blog_title"
                    :body="p.blog_body"
                    :author="p.blog_author"
                    :date="p.created_date"></v-blog>
            </li>
        </ul>
        <button class="btn btn-outline-primary"
                :disabled="pageNumber === 0"
                @click="prevPage">
            Previous
        </button>
        <button class="btn btn-outline-primary"
                :disabled="pageNumber >= pageCount -1"
                @click="nextPage">
            Next
        </button>
    </div>
</template>

<script>
    import BlogItem from './BlogItem.vue';
    export default {
        components: {
            'v-blog': BlogItem
        },
        props: {
            listData:{
                type:Array,
                required:true
            },
            size:{
                type:Number,
                required:false,
                default: 3
            }
        },
        data(){
            return {
                pageNumber: 0
            }
        },
        methods: {
            nextPage(){
                this.pageNumber++;
            },
            prevPage(){
                this.pageNumber--;
            }
        },
        computed: {
            pageCount(){
                let l = this.listData.length,
                    s = this.size;
                return Math.floor(l/s);
            },
            paginatedData(){
                const start = this.pageNumber * this.size,
                    end = start + this.size;
                return this.listData
                    .slice(start, end);
            }
        }
    }
</script>

<style lang="stylus" scoped>
    .padd-top-20
        padding-top 20px
</style>