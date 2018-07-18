<template>
      <div class="row">
          <v-head></v-head>
          <div class="container">
              <h3>{{ this.$route.params.id }}</h3>
              <v-comments></v-comments>
          </div>
      </div>
</template>

<script>
    import example from '../example';
    import Head from './Head.vue';
    import Comments from './Comments.vue';
    export default {
        components: {
            'v-comments': Comments,
            'v-head': Head
        },
        data(){
            return {
                blogs: example
            }
        },
        mounted(){
            console.log(this.blogs);
        }
    }
</script>

<style scoped>

</style>