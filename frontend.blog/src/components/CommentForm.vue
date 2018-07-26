<template>
    <div class="row padd-top-30">
         <form method="post" action="" @submit.prevent="onSubmit" class="col-md-8 offset-md-4">
              <div class="col-md-4">
                  <b-form-input v-model="comment.name"
                                type="text"
                                placeholder="Name"
                                required></b-form-input>
              </div>
              <div class="col-md-4 margin-top-15">
                  <b-form-input v-model="comment.email"
                                type="email"
                                placeholder="Email"
                                required></b-form-input>
              </div>
              <div class="col-md-4 margin-top-15">
                  <b-form-textarea
                          v-model="comment.body"
                          placeholder="Comments..."
                          :rows="3"
                          :max-rows="6"
                          required
                  >
                  </b-form-textarea>
              </div>
             <div class="row offset-md-1 margin-top-15">
                 <button type="submit" class="btn btn-outline-success">
                     Add comment
                 </button>
             </div>
         </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                comment: {
                    name: '',
                    email: '',
                    body: ''
                }
            }
        },
        methods: {
            onSubmit(e) {
                e.preventDefault();
            }
        }
    }
</script>

<style lang="stylus" scoped>
    .padd-top-30
        padding-top 30px
    .margin-top-15
        margin-top 15px
</style>