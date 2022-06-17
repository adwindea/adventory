<template>
    <AppLayout title="Product">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Product
                </h2>
            </div>
        </template>

        <div class="card w-full bg-white dark:bg-dark-eval-1 shadow-xl">
            <div class="card-body">
                <Table :header="tableHeader" :filters="filters" :filtering="filtering" :products="products" :customFilter="customFilter" :dest="route(route().current())"></Table>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import Table from '@/Components/Table'

export default {
    components: {
        Table,
    },
    // layout: AppLayout,
    props: {
        filters: Object,
        filtering: Object,
        products: Array,
        tableHeader: Object,
        customFilter: Object,
    },
    data() {
        return {

        }
    },
    methods: {

    },
}
</script>
<script setup>
    import AppLayout from '@/Layouts/AppLayout'
</script>
