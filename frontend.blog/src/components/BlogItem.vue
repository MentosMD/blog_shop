<template>
     <div class="row">
         <router-link v-bind:to="{name: 'blog_detail', params: {id: id}}" class="blog-item-title link col-md-10">
             {{ title }}
         </router-link>
         <div>
             <small class="blog-item-small">{{ author }}</small>
             <small class="blog-item-small">{{ date }}</small>
         </div>
     </div>
</template>

<script>
    export default {
        props: {
            blogs: {type: Array},
            id: {type: Number},
            title: {type: String},
            body: {type: String},
            author: {type: String},
            date: {type: String}
        },
        data(){
            return {

            }
        }
    }
</script>

<style lang="stylus" scoped>
    .blog-item-title
        font-size 20px
        font-style oblique
        font-family 'Merienda', cursive
        color #262728
        transition .2s ease
    .blog-item-title:hover
        color #ef5d43
        text-decoration none
    .blog-item-body
        font-family Poppins
    .blog-item-small
        font-family Poppins
        font-weight bolder
        color #8d9096
    .margin-bott-20
        margin-bottom 20px
    .padd-top-50
        padding-top 50px
    .link
        width 100%
</style>