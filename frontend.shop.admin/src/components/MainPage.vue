<template>
   <div>
     <head-component></head-component>
     <books-component></books-component>
   </div>
</template>
<script>
import Head from './Head.vue';
import BooksList from './BooksList.vue'
export default {
    components: {
        'head-component': Head,
        'books-component': BooksList
    }
}
</script>
<style lang="stylus" scoped>
h1
  color red
</style>