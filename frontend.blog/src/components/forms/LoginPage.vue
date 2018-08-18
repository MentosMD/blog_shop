<template>
    <div class="row">
        <v-head></v-head>
        <div class="container">
            <form method="post" action="#" @submit.prevent="onSubmit" class="col-md-8 offset-md-4">
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.login }}</label>
                    <b-form-input v-model="user.login"
                                  type="text"
                                  placeholder="Login"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.password }}</label>
                    <b-form-input v-model="user.password"
                                  type="password"
                                  placeholder="Password"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15 offset-md-1">
                    <button type="submit" class="btn btn-outline-success">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import * as config from '../../config';
    import Head from '../Head.vue';
    export default {
        components: {
            'v-head': Head
        },
        data() {
            return {
                user: {
                    login: '',
                    password: ''
                },
                errors: {
                    login: '',
                    password: ''
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
                axios.post(config.API_USER_LOGIN, {
                    login: self.user.login,
                    password: self.user.password
                }).then(data => {
                    localStorage.setItem('access_token', data.data.response);
                    this.notify('You are successfully authorized', 'success');
                    setTimeout(() => {
                        location.replace('/');
                    }, 1500);
                }).catch(err => {
                    let status = err.response.status;
                    let data = err.response.data;
                    if (status === 400) {
                        this.notify(data.message, 'error');
                    }
                    else if (status === 402) {
                        this.notify(data.message, 'error');
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>