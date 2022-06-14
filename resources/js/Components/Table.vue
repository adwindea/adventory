<template>
    <table class="table w-full">
        <thead>
            <tr>
                <th v-for="head in header" :key="head.value" :class="head.class" v-on="head.sortable ? { click : () => setOrderBy(head.value) } : {click: ($event) => $event.preventDefault() }">
                    {{ head.text }}
                    <span class="float-right" v-if="head.sortable">
                        <faicon icon="arrow-up" v-if="filter.sort==head.value && filter.direction=='asc'"/>
                        <faicon icon="arrow-down" v-if="filter.sort==head.value && filter.direction=='desc'"/>
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products.data" :key="product.xid">
                <td class="text-center">{{index+1}}</td>
                <td class="text-center">{{product.sku}}</td>
                <td>{{product.name}}</td>
                <td class="text-center">{{product.quantity}}</td>
                <td class="text-center">{{product.price}}</td>
            </tr>
            <tr v-if="products.data.length === 0">
                <td class="text-center" colspan="5">No products found.</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['header', 'filter', 'products'],

    methods: {
        setOrderBy(orderBy){
            this.filter.direction = this.filter.direction == 'asc' ? 'desc' : 'asc'
            this.filter.sort = orderBy        }
    }
}
</script>
