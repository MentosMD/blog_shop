<template>
     <div class="row">
         <v-head></v-head>
         <div class="container text-align-center padd-top-55">
             <h3>{{ this.book.title }}</h3>
             <h3>{{ this.book.author }}</h3>
             <h4>{{ this.book.pages }}</h4>
             <h4>{{ this.book.price }}$</h4>
             <p>{{ this.book.description }}</p>
             <div class="row display_flex-center">
                 <div class="col-md-1">
                     <router-link v-bind:to="`admin/book/edit/${this.book.id}`" class="btn btn-outline-primary">
                         <i class="fas fa-pencil-alt"></i>
                     </router-link>
                 </div>
                 <div class="col-md-1">
                     <button class="btn btn-outline-danger" @click="deleteBook(this.book.id)">
                         <i class="fas fa-trash-alt"></i>
                     </button>
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
                        self.notify('Successfully removed!', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }).catch((err) => {
                        console.log(err);
                    })
            }
        }
    }
</script>

<style scoped>

</style>