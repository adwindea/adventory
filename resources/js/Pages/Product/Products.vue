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
            <!-- <div class="card-body justify-content">
            </div> -->
            <div class="card-body overflow-x-auto">
                <input type="text" placeholder="Type to search" v-model="form.search" class="self-end input input-bordered w-full max-w-xs" />

                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="text-center" @click="setOrderBy('sku')">SKU</th>
                            <th @click="setOrderBy('name')">Name</th>
                            <th class="text-center" @click="setOrderBy('quantity')">Quantity</th>
                            <th class="text-center" @click="setOrderBy('price')">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products.data" :key="product.xid">
                            <td class="text-center">{{product.sku}}</td>
                            <td>{{product.name}}</td>
                            <td class="text-center">{{product.quantity}}</td>
                            <td class="text-center">{{product.price}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import mapValues from 'lodash/mapValues'

export default {
    components: {
        // AppLayout,
    },
    // layout: AppLayout,
    props: {
        filters: Object,
        products: Array,
    },
    data() {
        return {
            direction: 'asc',
            sort: 'name',
            form: {
                search: this.filters.search,
            //     trashed: this.filters.trashed,
            },
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get('/product', pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
    methods: {
        setOrderBy(orderBy) {
            this.direction = this.direction == 'asc' ? 'desc' : 'asc'
            this.sort = orderBy
            this.$inertia.get(route('product'), {
                'sort': orderBy,
                'direction': this.direction
            }, {
                preserveState: true
            })

        },
    //     reset() {
    //         this.form = mapValues(this.form, () => null)
    //     },
    },
}
</script>
<script setup>
    import AppLayout from '@/Layouts/AppLayout'
</script>
