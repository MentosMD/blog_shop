<template>
     <div class="row">
         <v-head></v-head>
         <div class="container text-align-center padd-top-55">
             <template v-if="book.image != null">
                 <img :src="require(`../assets/images/${this.book.image}`)" width="100" height="100"/>
             </template>
             <h3>Title: {{ this.book.title }}</h3>
             <h3>Author: {{ this.book.author }}</h3>
             <h4>Pages: {{ this.book.pages }}</h4>
             <h4>Price: {{ this.book.price }}$</h4>
             <p>Description: {{ this.book.description }}</p>
             <div class="row display_flex-center">
                 <div class="col-md-1 padd-0">
                     <button class="btn btn-outline-danger" @click="deleteBook(book.id)">
                         <i class="fas fa-trash-alt"></i>
                     </button>
                 </div>
                 <div class="col-md-1 padd-0">
                     <router-link :to="{name: 'edit_book', params: {id: this.book.id} }" class="btn btn-outline-primary">
                         <i class="fas fa-pencil-alt"></i></router-link>
                 </div>
             </div>
         </div>
     </div>
</template>

<script>
    import axios from 'axios'
    import * as config from '../config'
    import Head from './Head.vue'
    export default {
        components:{
            'v-head': Head
        },
        data(){
            return{
                id: this.$route.params.id,
                book: {}
            }
        },
        mounted(){
            axios.get(config.API_ADMIN_BOOK + this.id)
                .then((data) => {
                    this.book = data.data.response;
                }).catch((err) => {
                  console.log(err);
            })
        },
        methods:{
            notify(text, type){
                this.$notify({
                    group: 'example',
                    text: text,
                    type: type
                });
            },
            deleteBook(id){
                let self = this;
                axios.get(config.API_ADMIN_BOOK_DELETE + id)
                    .then((data) => {
                        let conf = confirm('Are you really delete this book?');
                        if (conf) {
                            self.notify('Successfully removed!', 'success');
                            setTimeout(() => {
                                window.location.replace('/');
                            }, 1000);
                        }
                    }).catch((err) => {
                        console.log(err);
                    })
            }
        }
    }
</script>

<style scoped>

</style>