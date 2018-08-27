<template>
      <div class="row">
          <v-head></v-head>
          <div class="container">
              <div class="row">
                   <h5 class="col-md-12 text-center">{{ blog.blog_title }}</h5>
                   <p class="col-md-12 word-break">{{ blog.blog_body }}</p>
              </div>
              <div class="row position">
                  <template v-if="token !== null">
                      <star-rating v-model="rating"
                                   :star-size="25"
                                   @rating-selected="ratingSelect">
                      </star-rating>
                  </template>
                  <div class="col-md-2 text-right">
                      <strong>Rating:</strong> {{_resultRatings(get_ratings)}}
                  </div>
              </div>
              <div class="row position">
                  <div class="col-md-4">
                      <i class="fas fa-user"></i>&nbsp;<strong>By:</strong>&nbsp;<router-link :to="{ name: 'user_detail', params: { id: author.id }}">{{author.firstname}}&nbsp;{{author.lastname}}</router-link>
                  </div>
                  <div class="col-md-3">
                      <button @click="like" class="btn btn-outline-primary">
                          <i class="fas fa-thumbs-up"></i>
                      </button>
                      <span>{{ likes.length }}</span>
                  </div>
              </div>
              <v-comments :comments="this.comments"></v-comments>
              <template v-if="token !== null">
                  <div class="container">
                      <v-comment-form :id="this.$route.params.id"></v-comment-form>
                  </div>
              </template>
              <template v-else>
                  <h5 class="text-center margin-top-20">No access to commenting,only authorized user. <router-link :to="{ name: 'login'}">Login</router-link></h5>
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
                comments: [],
                ratings: 0,
                get_ratings: [],
                author: {},
                likes: []
            }
        },
        mounted(){
            let self = this;
            axios.get(config.API_BLOG_GET + this.$route.params.id)
                .then(data => {
                    let res = data.data.response;
                    console.log(res.user);
                    self.author = res.profile[0];
                    self.blog = res.blog;
                    self.likes = res.blog.likes;
                    self.comments = res.comments;
                    self.get_ratings = res.blog.ratings;
                    self.ratings =  self._resultRatings(self.ratings);
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
            _resultRatings(rates) {
                if (rates.length === 0) {
                    return 0;
                }
                let blogRating = 0;
                let total = 0;
                rates.map(i => {
                     total += i.score;
                });
                blogRating = parseInt(total / rates.length);
                return blogRating;
            },
            like() {
                axios.post(config.API_BLOG_LIKE_ADD, {
                    count: 1,
                    token: localStorage.getItem('access_token'),
                    blog_id: this.$route.params.id
                }).then(data => {
                    this.notify('Successfully voted', 'success');
                }).catch(err => {
                    let data = err.response.data;
                    this.notify(data.message, 'error');
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

<style lang="stylus" scoped>
   .position
       display flex
       justify-content space-between
   .word-break
       word-break break-all
</style>