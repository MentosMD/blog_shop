<template>
    <div class="row">
        <div class="container">
            <vue-bootstrap-table
                    :columns="columns"
                    :values="values"
                    :show-filter="true"
                    :show-column-picker="true"
                    :sortable="true"
                    :paginated="true"
                    :multi-column-sortable=true
                    :filter-case-sensitive=false>

            </vue-bootstrap-table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import * as config from '../config'
    import VueBootstrapTable from 'vue2-bootstrap-table2'
    export default {
        components:{
            'vue-bootstrap-table': VueBootstrapTable
        },
        data(){
            return{
                books: [],
                columns: [
                    {
                        title:"id",
                    },
                    {
                        title:"name",
                        visible: true,
                        editable: true,
                    },
                    {
                        title:"age",
                        visible: true,
                        editable: true,
                    },
                    {
                        title:"country",
                        visible: true,
                        editable: true,
                    }
                ],
                values: [
                    {
                        "id": 1,
                        "name": "John",
                        "country": "UK",
                        "age": 25,
                    },
                    {
                        "id": 2,
                        "name": "Mary",
                        "country": "France",
                        "age": 30,
                    },
                    {
                        "id": 3,
                        "name": "Ana",
                        "country": "Portugal",
                        "age": 20,
                    }
                ]
            }
        },
        mounted(){
            axios.get(config.API_ADMIN_BOOKS)
                .then((data) => {
                    this.books = data.data.response;
                }).catch((err) => {
                   console.log(err);
                })
        }
    }
</script>

<style scoped>

</style>