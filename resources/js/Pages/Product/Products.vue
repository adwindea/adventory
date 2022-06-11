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
                <div class="card-title justify-start">
                    <input type="text" placeholder="Type to search" v-model="form.search" class="input input-bordered w-full max-w-xs" />
                    <!-- <div class="dropdown dropdown-right">
                        <label tabindex="0" class="btn m-1">Filter</label>
                        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a>Item 1</a></li>
                            <li><a>Item 2</a></li>
                        </ul>
                    </div> -->
                    <button class="btn px-2" @click="reset">Reset</button>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th class="text-center" @click="setOrderBy('sku')">SKU
                                    <span class="float-right">
                                        <faicon icon="arrow-up" v-if="sort=='sku' && direction=='asc'"/>
                                        <faicon icon="arrow-down" v-if="sort=='sku' && direction=='desc'"/>
                                    </span>
                                </th>
                                <th @click="setOrderBy('name')">Name
                                    <span class="float-right">
                                        <faicon icon="arrow-up" v-if="sort=='name' && direction=='asc'"/>
                                        <faicon icon="arrow-down" v-if="sort=='name' && direction=='desc'"/>
                                    </span>
                                </th>
                                <th class="text-center" @click="setOrderBy('quantity')">Quantity
                                    <span class="float-right">
                                        <faicon icon="arrow-up" v-if="sort=='quantity' && direction=='asc'"/>
                                        <faicon icon="arrow-down" v-if="sort=='quantity' && direction=='desc'"/>
                                    </span>
                                </th>
                                <th class="text-center" @click="setOrderBy('price')">Price
                                    <span class="float-right">
                                        <faicon icon="arrow-up" v-if="sort=='price' && direction=='asc'"/>
                                        <faicon icon="arrow-down" v-if="sort=='price' && direction=='desc'"/>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products.data" :key="product.xid">
                                <td class="text-center">{{product.sku}}</td>
                                <td>{{product.name}}</td>
                                <td class="text-center">{{product.quantity}}</td>
                                <td class="text-center">{{product.price}}</td>
                            </tr>
                            <tr v-if="products.data.length === 0">
                                <td class="text-center" colspan="4">No products found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-actions justify-between">
                    <div class="btn-group">
                        <Link v-for="paging in products.links" :href="paging.url" :key="paging.label"
                            class="btn"
                            :class="{'btn-active':paging.active}"
                            v-html="paging.label"
                        ></Link>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import mapValues from 'lodash/mapValues'
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link,
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
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },
}
</script>
<script setup>
    import AppLayout from '@/Layouts/AppLayout'
</script>
