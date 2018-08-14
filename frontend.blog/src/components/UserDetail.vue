<template>
    <div class="row">
        <v-head></v-head>
        <div class="container padd-top-55">
            <h4>{{ profile.firstname }}&nbsp;{{ profile.lastname }}</h4>
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