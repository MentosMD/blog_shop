<template>
     <div class="row">
         <v-head></v-head>
         <div class="container">
             <v-categories></v-categories>
         </div>
     </div>
</template>

<script>
    import Head from './Head.vue';
    import CategoriesList from './CategoriesList.vue';
    export default {
        components: {
            'v-head': Head,
            'v-categories': CategoriesList
        },
        data(){
            return {

            }
        }
    }
</script>

<style lang="stylus" scoped>

</style>