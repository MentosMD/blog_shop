<template>
    <div class="container">
         <nav class="row menu">
             <ul>
                 <li><a href="/">Blog</a></li>
                 <li><a target="_blank" href="http://localhost:2000/"><span><i class="fas fa-shopping-cart"></i> Shop</span></a></li>
                 <template v-if="token === null">
                     <li><a href="#/user/register">Register</a></li>
                     <li><a href="#/user/login">Login</a></li>
                 </template>
                 <template v-if="token !== null">
                     <li><a href="#/profile"><span><i class="fas fa-user"></i> My profile</span></a></li>
                     <li><a href="#" @click="exitSystem"><span><i class="fas fa-sign-out-alt"></i> Exit</span></a></li>
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