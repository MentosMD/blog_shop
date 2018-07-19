<template>
     <div class="row">
         <router-link v-bind:to="`blog/detail/${id}`" class="blog-item-title link">
             {{ title }}
         </router-link>
         <p class="blog-item-body">{{ body }}</p>
         <div class="col-md-8 float-right">
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
        color #2c6823
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
        text-align center
        width 100%
</style>