<template>
    <div class="row">
        <v-head></v-head>
        <div class="container text-align-center padd-top-55">
            <form method="post" action="" class="offset-md-4" @submit.prevent="onSubmit">
                <div class="col-md-4 margin-top-15">
                    <img :src="require(`../../assets/images/${book.image}`)" width="100" height="100" />
                </div>
                <div class="col-md-4 margin-top-15">
                    <b-form-file @change="onFileChange"></b-form-file>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.title }}</label>
                    <b-form-input v-model="book.title"
                                  type="text"
                                  placeholder="Title"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.author }}</label>
                    <b-form-input v-model="book.author"
                                  type="text"
                                  placeholder="Author"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label>{{ errors.pages }}</label>
                    <b-form-input v-model.number="book.pages"
                                  type="text"
                                  placeholder="Pages"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.price }}</label>
                    <b-form-input v-model.number="book.price"
                                  type="number"
                                  placeholder="Price"></b-form-input>
                </div>
                <div class="col-md-4 margin-top-15">
                    <label class="text-danger">{{ errors.description }}</label>
                    <b-form-textarea
                            v-model="book.description"
                            placeholder="Annotations"
                            :rows="3"
                            :max-rows="6"
                    >
                    </b-form-textarea>
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
                book: {},
                errors: {
                    title: '',
                    author: '',
                    pages: null,
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
                        let errors = err.response.data[0];
                        for(let attr in errors)
                        {
                            self.errors[attr] = errors[attr].join();
                        }
                       console.log(err);
                });
            },
            onFileChange(e){

            }
        }
    }
</script>

<style scoped>

</style>