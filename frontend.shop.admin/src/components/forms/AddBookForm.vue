<template>
    <div class="row">
        <head-component></head-component>
        <div class="container">
            <form method="post" class="col-md-8">
                <b-form-input class="form__input" placeholder="Title"></b-form-input>
            </form>
        </div>
    </div>
</template>

<script>
    import Head from '../Head.vue'
    export default {
        components: {
            'head-component': Head
        }
    }
</script>

<style scoped>

</style>