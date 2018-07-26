<template>
      <div class="row">
          <v-head></v-head>
          <div class="container">
              <div class="row">
                   <h4>{{ blog.blog_title }}</h4>
                   <p>{{ blog.blog_body }}</p>
              </div>
              <v-comments :comments="this.comments"></v-comments>
              <div class="container">
                  <v-comment-form></v-comment-form>
              </div>
          </div>
      </div>
</template>

<script>
    import axios from 'axios';
    import Head from './Head.vue';
    import Comments from './Comments.vue';
    import CommentForm from './CommentForm.vue';
    import * as config from '../config';
    export default {
        components: {
            'v-comment-form': CommentForm,
            'v-comments': Comments,
            'v-head': Head
        },
        data(){
            return {
                blog: {
                    blog_title: '',
                    blog_body: ''
                },
                comments: []
            }
        },
        mounted(){
            axios.get(config.API_BLOG_GET + this.$route.params.id)
                .then(data => { this.blog = data.data.response; })
                .catch(err => {});
            axios.get(config.API_COMMENT_GET + this.$route.params.id)
                .then(data => { this.comments = data.data.response; })
                .catch(err => {});
        },
        methods: {
        }
    }
</script>

<style scoped>

</style>