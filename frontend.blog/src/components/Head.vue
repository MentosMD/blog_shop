<template>
    <div class="container">
         <nav class="row menu">
             <ul>
                 <li><a href="/">Blog</a></li>
                 <li><a href="#/prayers">Prayers</a></li>
                 <li><a target="_blank" href="http://localhost:2000/">Shop</a></li>
                 <template v-if="token === null">
                     <li><a href="#/user/register">Register</a></li>
                     <li><a href="#/user/login">Login</a></li>
                 </template>
                 <template v-if="token !== null">
                     <li><a href="#/profile">My profile</a></li>
                     <li><a href="#" @click="exitSystem">Exit</a></li>
                 </template>
             </ul>
         </nav>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                token: localStorage.getItem('access_token')
            }
        },
        methods: {
            exitSystem() {
                localStorage.clear();
                location.replace('/');
            }
        }
    }
</script>

<style lang="stylus" scoped>

</style>