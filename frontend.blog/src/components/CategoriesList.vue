<template>
    <div class="row">
        <div class="container">
            <ul>
                <li v-for="category in categories">
                      <v-category :name="category.name"></v-category>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import CategoryItem from './CategoryItem.vue';
    import categories from '../categories';
    export default {
        components: {
            'v-category': CategoryItem
        },
        data(){
            return {
                categories: categories
            }
        },
        mounted(){

        }
    }
</script>

<style lang="stylus" scoped>

</style>