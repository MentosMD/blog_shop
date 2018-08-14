<template>
    <div class="row">
        <v-head></v-head>
        <div class="container padd-top-55">
            <h3 class="txt-center">My profile</h3>
            <b-tabs>
                <b-tab title="Update Profile" active>
                    <form method="post" action="#" @submit.prevent="onSubmit" class="col-md-8 offset-md-4">
                        <div class="col-md-4 margin-top-15">
                            <b-form-input v-model="user.firstname"
                                          type="text"
                                          placeholder="First name"></b-form-input>
                        </div>
                        <div class="col-md-4 margin-top-15">
                            <b-form-input v-model="user.lastname"
                                          type="text"
                                          placeholder="Last name"></b-form-input>
                        </div>
                        <div class="col-md-4 margin-top-15">
                            <b-form-input v-model="user.age"
                                          type="text"
                                          placeholder="Age"></b-form-input>
                        </div>
                        <div class="col-md-4 margin-top-15">
                            <b-form-textarea
                                    v-model="user.about"
                                    placeholder="About me..."
                                    :rows="3"
                                    :max-rows="6"
                            ></b-form-textarea>
                        </div>
                        <div class="col-md-4 margin-top-15">
                            <b-form-select v-model="user.country" :options="countries" />
                        </div>
                        <div class="row margin-top-15 offset-md-1">
                            <button type="submit" class="btn btn-outline-success">Update</button>
                        </div>
                    </form>
                </b-tab>
                <b-tab title="Change password">
                    <pass-change></pass-change>
                </b-tab>
                <b-tab title="Articles" >
                    <blogs-table :blogs="blogs" :ratings="ratings"></blogs-table>
                </b-tab>
                <b-tab title="Delete Profile">
                    <button type="button" class="btn btn-outline-danger margin-top-15" @click="deleteProfile()">Delete Profile</button>
                </b-tab>
            </b-tabs>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Head from './Head.vue';
    import * as config from '../config';
    import ArticlesProfile from './ArticlesProfile.vue';
    import ChangePassword from './forms/ChangePassword.vue';
    export default {
        components: {
            'v-head': Head,
            'blogs-table': ArticlesProfile,
            'pass-change': ChangePassword
        },
        data() {
            return {
                countries: [
                    {value: 'USA', text: 'USA'},
                    {value: 'Russia', text: 'Russia'},
                    {value: 'Germany', text: 'Germany'},
                    {value: 'France', text: 'France'},
                ],
                token: localStorage.getItem('access_token'),
                user: {
                    firstname: '',
                    lastname: '',
                    age: '',
                    about: '',
                    country: ''
                },
                blogs: [],
                ratings: []
            }
        },
        mounted() {
            axios.post(config.API_PROFILE, {
                token: this.token
            }).then(data => {
                    this.user = data.data.response[0];
                }).catch(err => {});

            axios.post(config.API_USER_BLOGS, {
                token: this.token
            }).then(
                data => {
                    let res = data.data.response;
                    this.blogs = res.blogs;
                    this.ratings = res.ratings;
                }
            ).catch(err => {});
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
                axios.post(config.API_PROFILE_UPDATE, {
                    first_name: self.user.firstname,
                    last_name: self.user.lastname,
                    age: self.user.age,
                    token: this.token
                }).then(data => { location.reload(); })
                  .catch(err => {});
            },
            deleteProfile() {
                let conf = confirm("Are you really want to delete your profile?");
                if (conf) {
                    axios.post(config.API_PROFILE_DELETE, {
                        token: this.token
                    }).then(data => {
                        localStorage.clear();
                        this.notify('Successfully deleted profile!', 'success');
                        setTimeout(() => {
                            location.replace('/');
                        }, 1500);
                    }).catch(err => {});
                }
            }
        }
    }
</script>

<style lang="stylus" scoped>
    .txt-center
        text-align center
</style>