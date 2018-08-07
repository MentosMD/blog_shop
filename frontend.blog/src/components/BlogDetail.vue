<template>
      <div class="row">
          <v-head></v-head>
          <div class="container">
              <div class="row">
                   <h4>{{ blog.blog_title }}</h4>
                   <p>{{ blog.blog_body }}</p>
              </div>
              <div class="row">
                  <star-rating v-model="rating"
                               :star-size="25"
                                @rating-selected="ratingSelect">
                  </star-rating>
              </div>
              <v-comments :comments="this.comments"></v-comments>
              <template v-if="token !== null">
                  <div class="container">
                      <v-comment-form :id="this.$route.params.id"></v-comment-form>
                  </div>
              </template>
          </div>
      </div>
</template>

<script>
    import axios from 'axios';
    import Head from './Head.vue';
    import Comments from './Comments.vue';
    import CommentForm from './CommentForm.vue';
    import * as config from '../config';
    import StarRating from 'vue-star-rating'
    export default {
        components: {
            'v-comment-form': CommentForm,
            'v-comments': Comments,
            'v-head': Head,
            'star-rating': StarRating
        },
        data(){
            return {
                token: localStorage.getItem('access_token'),
                blog: {
                    blog_title: '',
                    blog_body: ''
                },
                rating: '',
                comments: []
            }
        },
        mounted(){
            axios.get(config.API_BLOG_GET + this.$route.params.id)
                .then(data => {
                    this.blog = data.data.response.blog;
                    this.comments = data.data.response.blog.comments;
                })
                .catch(err => {});
        },
        methods: {
            notify(text, type){
                this.$notify({
                    group: 'example',
                    text: text,
                    type: type
                });
            },
            ratingSelect(e) {
                axios.post(config.API_BLOG_RATING, {
                      score: e,
                      token: localStorage.getItem('access_token'),
                      blog_id: this.$route.params.id
                }).then(data => {
                        this.notify('Successfully voted', 'success');
                    }).catch(err => {
                        this.notify('You have voted!', 'error');
                    });
            }
        }
    }
</script>

<style scoped>

</style>