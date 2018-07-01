<template>
    <div class="row">
        <div class="container">
            <h2>{{ id }}</h2>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data(){
            return{
                id: this.$route.params.id
            }
        },
        mounted(){
            console.log(this.id);
        }
    }
</script>

<style scoped>

</style>