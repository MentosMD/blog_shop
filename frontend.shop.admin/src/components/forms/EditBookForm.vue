<template>
    <div class="row">
        <v-head></v-head>
        <div class="container text-align-center padd-top-55">
            <form method="post" action="#" class="offset-md-4" @submit.prevent="onSubmit">
                <div class="col-md-4 margin-top-15">
                    <b-form-input v-model="book.title"
                                  type="text"
                                  placeholder="Title"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <b-form-input v-model="book.author"
                                  type="text"
                                  placeholder="Author"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <b-form-input v-model.number="book.pages"
                                  type="text"
                                  placeholder="Pages"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <b-form-input v-model.number="book.price"
                                  type="number"
                                  placeholder="Price"></b-form-input>
                </div>
                <div class="col-md-1 offset-md-1 margin-top-15">
                    <button type="submit" class="btn btn-outline-success">Edit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Head from '../Head.vue';
    import * as config from '../../config'
    import axios from 'axios'
    export default {
        components: {
            'v-head': Head
        },
        data(){
            return {
                book:
                    {
                      title: '',
                      pages: null,
                      author: '',
                      price: null,
                      description: ''
                    }
            }
        },
        mounted(){
            axios.get(config.API_ADMIN_BOOK + this.$route.params.id)
                .then((data) => {
                    this.book = data.data.response;
                }).catch((err) => {
                   console.log(err);
            });
        },
        methods: {
            notify(text, type){
                this.$notify({
                    group: 'example',
                    text: text,
                    type: type
                });
            },
            onSubmit(e){
                let self = this;
                axios.post(config.API_ADMIN_BOOK_UPDATE, self.book)
                    .then((data) => {
                        self.notify('Updated successfully!', 'success');
                        setTimeout(() => {
                            location.replace('/');
                        }, 1000);
                    }).catch((err) => {
                       console.log(err);
                });
            }
        }
    }
</script>

<style scoped>

</style>