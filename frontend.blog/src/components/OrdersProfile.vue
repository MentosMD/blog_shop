<template>
    <div class="row">
        <b-table striped hover
                 :items="orders"
                 :fields="fields"
                 :current-page="currentPage"
                 :per-page="perPage"
                 :filter="filter"
                 @filtered="onFiltered"
        >
        </b-table>
    </div>
</template>

<script>

    export default {
        props: {
            orders: {type: Array},
        },
        data() {
            return {
                filter: null,
                currentPage: 1,
                perPage: 5,
                totalRows: 0,
                fields: [
                    {
                        key: 'id',
                        label: '#'
                    },
                    {
                        key: 'OrderDate',
                        label: 'Date'
                    },
                    {
                        key: 'OrderQuantity',
                        label: 'Quantity'
                    },
                    {
                        key: 'OrderTotal',
                        label: 'Total'
                    },
                    {
                        key: 'status',
                        label: 'Status'
                    }
                ]
            }
        },
        methods: {

            onFiltered (filteredItems) {
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            },
        }
    }
</script>

<style scoped>

</style>