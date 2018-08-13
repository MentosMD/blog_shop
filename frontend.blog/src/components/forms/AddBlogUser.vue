<template>
    <div class="row">
        <v-head></v-head>
        <div class="container">
            <form method="post" @submit.prevent="onSubmit">
                <div class="row margin-top-15">
                    <label class="text-danger">{{ errors.blog_title }}</label>
                    <b-form-input v-model="blog.blog_title"
                                  type="text"
                                  placeholder="Title"></b-form-input>
                </div>
                <div class="row margin-top-15">
                    <label class="text-danger">{{ errors.blog_body }}</label>
                    <b-form-textarea
                            v-model="blog.blog_body"
                            placeholder="Annotations..."
                            :rows="3"
                            :max-rows="6"
                    ></b-form-textarea>
                </div>
                <div class="col-md-4 margin-top-15 offset-md-5">
                    <button type="submit" class="btn btn-outline-success">Add blog</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Head from '../Head.vue';
    import * as config from '../../config';
    export default {
       components: {
           'v-head': Head
       },
        data() {
           return {
               blog: {
                   blog_title: '',
                   blog_body: ''
               },
               errors: {
                   blog_title: '',
                   blog_body: ''
               }
           }
        },
        methods: {
            notify(text, type){
                this.$notify({
                    group: 'example',
                    text: text,
                    type: type
                });
            },
           onSubmit(e) {
               let self = this;
               axios.post(config.API_PROFILE_BLOG_ADD, {
                   blog_title: self.blog.blog_title,
                   blog_body: self.blog.blog_body,
                   token: localStorage.getItem('access_token')
               }).then(data => {
                   this.notify('Successfully added!', 'success');
                   setTimeout(() => {
                       location.replace('/');
                   }, 1500);
               })
                   .catch(err => {});
           }
        }
    }
</script>

<style scoped>

</style>