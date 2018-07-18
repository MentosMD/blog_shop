<template>
    <div class="row">
         <form method="post" action="" @submit.prevent="onSubmit">
              <div class="col-md-4">
                  <b-form-input v-model="comment.name"
                                type="text"
                                placeholder="Name"
                                required></b-form-input>
              </div>
              <div class="col-md-4">
                  <b-form-input v-model="comment.email"
                                type="email"
                                placeholder="Email"
                                required></b-form-input>
              </div>
              <div class="col-md-4">
                  <b-form-textarea
                          v-model="comment.body"
                          placeholder="Comments..."
                          :rows="3"
                          :max-rows="6"
                          required
                  >
                  </b-form-textarea>
              </div>
             <div class="col-md-1">
                 <button type="submit">
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

<style scoped>

</style>