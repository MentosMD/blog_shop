<template>
    <div class="row">
        <div class="container">
            <blog-item :blogs="blogs"></blog-item>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import BlogItem from './BlogItem.vue';
    import example from '../example';
    export default {
        components: {
           'blog-item': BlogItem
        },
        data(){
            return {
                blogs: example
            }
        },
        mounted(){

        }
    }
</script>

<style scoped>

</style>