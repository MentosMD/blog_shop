<template>
    <div class="row">
        <form method="post" action="#" @submit.prevent="onSubmit" class="col-md-8 offset-md-4">
            <div class="col-md-4 margin-top-15">
                <b-form-input v-model="password"
                              type="password"
                              placeholder="Password"
                              required></b-form-input>
            </div>
            <div class="col-md-4 margin-top-15">
                <b-form-input v-model="repeat_password"
                              type="password"
                              placeholder="Repeat Password"
                              required></b-form-input>
            </div>
            <div>
                <button type="submit" class="btn btn-outline-success margin-top-15 offset-md-1">
                    Update
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';
    import * as config from '../../config';
    export default {
        data() {
            return {
                password: '',
                repeat_password: ''
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
                if (self.password !== self.repeat_password) {
                    self.notify('Your passwords does not match', 'error');
                }
                axios.post(config.API_USER_UPDATE_PASSWORD, {
                    password: self.password,
                    repeat_password: self.repeat_password,
                    token: localStorage.getItem('access_token')
                }).then(data => self.notify('Successfully changed your password', 'success'))
                    .catch(err => {});
            }
        }
    }
</script>

<style scoped>

</style>