<template>
    <div class="row">
        <v-head></v-head>
        <div class="container padd-top-55">
            <div class="col-md-5 text-right float-left">
                <h4>Login: <i>{{user.login}}</i></h4>
                <h4>Password: <i>{{user.password}}</i></h4>
                <h4>Email: <i>{{user.email}}</i></h4>
                <h4>First name: <i>{{user.profile.firstname}}</i></h4>
                <h4>Last name: <i>{{user.profile.lastname}}</i></h4>
                <h4>Age: <i>{{user.profile.age}}</i></h4>
                <h4>Country: <i>{{user.profile.country}}</i></h4>
                <h4>About: </h4><i>{{user.profile.about}}</i>
            </div>
            <div class="col-md-4 float-right">
                <button class="btn btn-outline-danger" @click="deleteUser()">Delete user</button>
                <button class="btn btn-outline-danger">Block</button>
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
                user: {}
            }
        },
        mounted() {
            axios.get(config.API_ADMIN_USER_DETAIL + this.$route.params.id)
                .then(data => { this.user = data.data.response; })
                .catch(err => {});
        },
        methods: {
            deleteUser() {
                axios.get(config.API_ADMIN_USER_DELETE + this.user.id)
                    .then(data => {
                        setTimeout(() => {
                            location.replace('/');
                        }, 1500);
                    }).catch(err => {});
            }
        }
    }
</script>

<style scoped>

</style>