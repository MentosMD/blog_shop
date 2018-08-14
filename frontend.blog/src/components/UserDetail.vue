<template>
    <div class="row">
        <v-head></v-head>
        <div class="container padd-top-55">
            <h4 class="text-center">{{ profile.firstname }}&nbsp;{{ profile.lastname }}</h4>
            <div class="col-md-3 offset-md-4">
                <h5>Age: <i>{{profile.age}}</i></h5>
                <h5>About me: </h5><i>{{profile.about}}</i>
                <h5>Country: <i>{{profile.country}}</i></h5>
                <h5>Count of articles: <i>{{blogs.length}}</i></h5>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import * as config from '../config';
    import Head from './Head.vue';
    export default {
        components: {
            'v-head': Head
        },
        data() {
            return {
                profile: {},
                blogs: []
            }
        },
        mounted() {
            axios(config.API_PROFILE_DETAIL + this.$route.params.id)
                .then(data => {
                    let self = this;
                    let res = data.data.response;
                    self.profile = res.profile;
                    self.blogs = res.blogs;
                })
                .catch(err => {});
        }
    }
</script>

<style scoped>

</style>