<template>
   <div>
     <head-component></head-component>
     <h1>Hello!</h1>
   </div>
</template>
<script>
import Head from './Head.vue';
export default {
    components: {
        'head-component': Head
    }
}
</script>
<style lang="stylus" scoped>
h1
  color red
</style>