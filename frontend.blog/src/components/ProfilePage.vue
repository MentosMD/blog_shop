<template>
    <div class="row">
        <v-head></v-head>
        <div class="container">
            My profile
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Head from './Head.vue';
    import * as config from '../config';
    export default {
        components: {
            'v-head': Head
        },
        data() {
            return {
                token: localStorage.getItem('access_token')
            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>