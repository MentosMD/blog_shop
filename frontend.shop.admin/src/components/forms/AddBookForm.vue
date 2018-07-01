<template>
    <div class="row">
        <head-component></head-component>
        <div class="container padd-top-55">
            <form method="post" class="col-md-8 offset-md-4">
                <div class="col-md-4">
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
                <div class="col-md-1 margin-top-15 offset-md-1">
                    <button type="button" class="btn btn-outline-success">Send</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Head from '../Head.vue'
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
                    description: ''
                }
            }
        }
    }
</script>

<style scoped>

</style>