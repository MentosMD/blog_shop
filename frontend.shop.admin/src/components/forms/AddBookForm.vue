<template>
    <div class="row">
        <head-component></head-component>
        <div class="container padd-top-55">
            <form method="post" class="col-md-8 offset-md-4">
                <div class="col-md-4">
                    <div v-if="img.length > 0">
                        <img :src="img" width="100" height="100" />
                    </div>
                    <div class="margin-top-15">
                        <b-form-file @change="onFileChange"></b-form-file>
                    </div>
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
                <div class="col-md-1 margin-top-15 offset-md-1">
                    <button type="button" class="btn btn-outline-success" @click="onSubmit">Send</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Head from '../Head.vue'
    import axios from 'axios'
    import * as config from '../../config'
    export default {
        components: {
            'head-component': Head
        },
        data(){
            return{
                book: {
                    title: '',
                    pages: null,
                    author: '',
                    price: null,
                    description: '',
                    image: ''
                },
                img: '',
                errors: {
                    title: '',
                    author: '',
                    pages: null,
                    price: null,
                    description: ''
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
                axios.post(config.API_ADMIN_BOOK_ADD, self.book)
                    .then((data) => {
                        this.notify('Successfully added book!', 'success');
                        location.replace('/');
                        this.errors = {};
                    }).catch((err) => {
                        let errors = err.response.data[0];
                        for(let attr in errors)
                        {
                            self.errors[attr] = errors[attr].join();
                        }
                        switch(err.status){
                            case 500:
                                this.notify('Service is not working!', 'error');
                                break;
                        }
                });
            },
            onFileChange(e){
                let file = e.target.files || e.dataTransfer.files;
                if(!file.length)
                    return;
                this.createImage(file[0]);
            },
            createImage(file){
                let reader = new FileReader();
                let self = this;
                reader.onload = (e) => {
                    self.img = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            testImage(){
            }
        }
    }
</script>

<style lang="stylus" scoped>

</style>