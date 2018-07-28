<template>
   <div>
     <head-component></head-component>
     <blog-list></blog-list>
   </div>
</template>
<script>
import Head from './Head.vue';
import BlogList from './BlogList.vue';
export default {
    components: {
        'head-component': Head,
        'blog-list': BlogList
    }
}
</script>
<style lang="stylus" scoped>
h1
  color red
</style>