<template>
    <div class="row">
        <v-head></v-head>
        <div class="container padd-top-20">
            <div class="col-md-10 block-prayer offset-md-1 padd-0">
                <div class="prayer-wall">
                    <h2 class="title">PRAYER WALL</h2>
                </div>
                <div class="col-md-6 padd-0 float-left margin-top-20">
                    <p>
                        Dear brothers and sisters, we will be happy to participate in your needs.
                        <br/>
                        Leave your requests below so that we can pray together!
                        <br/>
                        If the Lord has answered your prayer - share it with others!
                        <br/>
                        Let your witness be an inspiration to many who are still waiting for a response from God.
                    </p>
                </div>
                <div class="col-md-6 quote_box float-right margin-top-20">
                    <blockquote>
                        <p>
                            15 And the prayer of faith will heal the sick, and the Lord will raise him up; and if he has committed sins, they will be forgiven him.
                            <br/>
                            16 Admit to one another in misdeeds and pray for one another to be healed: much can the intensified prayer of the righteous
                            <br/>
                            (James.5:15,16)
                        </p>
                        <p>
                            1 So pray for us, brethren, that the word of the Lord may be spread and glorified, as it is with you,
                            <br/>
                            2 and that we should get rid of the messy and crafty people, for not all people believe
                            <br/>
                            (2Thess.3:1,2)
                        </p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Head from './Head.vue';
    export default {
        components: {
           'v-head': Head
        },
        data(){
            return{

            }
        }
    }
</script>

<style lang="stylus" scoped>
    .block-prayer
         height 326px
    .prayer-wall
          height 90px
          text-align center
          border 2px dashed #e58734
    .title
       color #e58734
       line-height 72px
    .padd-top-20
          padding-top 20px
    .quote_box
        border-left 2px solid #4db2ec
</style>