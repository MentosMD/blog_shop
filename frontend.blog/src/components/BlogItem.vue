<template>
     <div class="row blog-item">
          <ul class="row padd-top-50">
             <li v-for="blog in blogs" class="row margin-bott-20">
                  <router-link v-bind:to="`blog/detail/${blog.id}`" class="blog-item-title link">
                      {{ blog.title }}
                  </router-link>
                  <p class="blog-item-body">{{ blog.body }}</p>
                  <div class="col-md-8 float-right">
                      <small class="blog-item-small">{{ blog.author }}</small>
                      <small class="blog-item-small">{{ blog.date }}</small>
                  </div>
             </li>
          </ul>
     </div>
</template>

<script>
    export default {
        props: {
            blogs: {
                type: Array
            }
        },
        data(){
            return {

            }
        }
    }
</script>

<style lang="stylus" scoped>
    .blog-item ul li
        list-style none
        border-bottom 2px solid #2c6823
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