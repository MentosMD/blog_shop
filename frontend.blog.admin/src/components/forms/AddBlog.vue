<template>
    <div class="row">
        <v-head></v-head>
        <div class="container">
            <form method="post" action="#" @submit.prevent="onSubmit">
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
                <div class="col-md-4 margin-top-15">
                    <button type="submit" class="btn btn-outline-success">Add blog</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Head from '../Head.vue';
    import axios from 'axios';
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
            onSubmit(e) {
                let self = this;
                axios.post(config.API_ADMIN_BLOG_ADD, {
                    blog_title: self.blog.blog_title,
                    blog_body: self.blog.blog_body
                }).then(data => { location.reload('/'); })
                  .catch(err => {});
            }
        }
    }
</script>

<style scoped>

</style>