<template>
     <div class="row">
          <ul>
             <li v-for="blog in blogs">
                  <h4>{{ blog.title }}</h4>
                  <h4>{{ blog.body }}</h4>
                  <h4>{{ blog.author }}</h4>
                  <h4>{{ blog.date }}</h4>
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

<style scoped>

</style>