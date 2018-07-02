<template>
     <div class="row">
         <v-head></v-head>
         <div class="container">
             {{ id }}
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
        }
    }
</script>

<style scoped>

</style>