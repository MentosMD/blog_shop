<template>
    <div class="row blog-comments">
        <div class="comment" v-for="comment in comments">
            <h5><i class="fas fa-user"></i> {{ comment.firstname }}&nbsp;{{ comment.lastname }}</h5>
            <p>{{ comment.comment }}</p>
            <span>{{ comment.created_date }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            comments: {
                type: Array,
                required: true
            }
        },
        data() {
            return {

            }
        }
    }
</script>

<style lang="stylus" scoped>
    .blog-comments
         display list-item
         list-style none
    .comment
        border 2px solid gray
        margin-top 20px
        padding-left 11px
        height 140px
</style>