<template>
    <div class="row">
        <v-head></v-head>
        <div class="container">
            <form method="post" action="#">
                <div class="col-md-4">
                    <b-form-input v-model="book.title"
                                  type="text"
                                  placeholder="Title"></b-form-input>
                </div>
                <div class="col-md-4">
                    <b-form-input v-model="book.author"
                                  type="text"
                                  placeholder="Author"></b-form-input>
                </div>
                <div class="col-md-4">
                    <b-form-input v-model.number="book.pages"
                                  type="text"
                                  placeholder="Pages"></b-form-input>
                </div>
                <div class="col-md-4">
                    <b-form-input v-model.number="book.price"
                                  type="number"
                                  placeholder="Price"></b-form-input>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline-success">Edit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Head from '../Head.vue';
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
        }
    }
</script>

<style scoped>

</style>