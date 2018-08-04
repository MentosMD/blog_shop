<template>
    <div class="row">
        <v-head></v-head>
        <div class="container">
            <form method="post" action="#" @submit.prevent="onSubmit" class="col-md-8 offset-md-4">
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.login }}</label>
                    <b-form-input v-model="user.login"
                                  type="text"
                                  required
                                  pattern=".{1,100}"
                                  placeholder="Login"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.email }}</label>
                    <b-form-input v-model="user.email"
                                  type="text"
                                  required
                                  placeholder="Email"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.first_name }}</label>
                    <b-form-input v-model="user.first_name"
                                  type="text"
                                  required
                                  pattern=".{1,255}"
                                  placeholder="First Name"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.last_name }}</label>
                    <b-form-input v-model="user.last_name"
                                  type="text"
                                  required
                                  pattern=".{1,255}"
                                  placeholder="Last Name"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.password }}</label>
                    <b-form-input v-model="user.password"
                                  type="password"
                                  required
                                  pattern=".{1,255}"
                                  placeholder="Password"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15 offset-md-1">
                     <button type="submit" class="btn btn-outline-success">Register</button>
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
                    email: '',
                    password: '',
                    first_name: '',
                    last_name: ''
                },
                errors: {
                    login: '',
                    email: '',
                    first_name: '',
                    last_name: '',
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
                axios.post(config.API_USER_REGISTER, {
                    login: self.user.login,
                    email: self.user.email,
                    password: self.user.password,
                    first_name: self.user.first_name,
                    last_name: self.user.last_name
                }).then(data => {
                    localStorage.setItem('access_token', data.data.response);
                    this.notify('Successfully registered!');
                    setTimeout(() => {
                        location.replace('/');
                    }, 1500);
                })
                    .catch(err => {
                        let errors = err.response.data.response;
                        for(let attr in errors)
                        {
                            self.errors[attr] = errors[attr].join();
                        }
                    });
            }
        }
    }
</script>

<style lang="stylus" scoped>

</style>