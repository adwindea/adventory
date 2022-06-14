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
                <Table :header="tableHeader" :filter="form" :products="products"></Table>
            </div>
            <div class="card-body">
                <div class="card-title flex-wrap justify-between">
                    <div class="flex-wrap w-full max-w-lg">
                        <input type="text" placeholder="Type to search" v-model="form.search" class="input input-bordered w-full max-w-xs mr-2 mb-2" />
                        <div class="dropdown dropdown-right">
                            <label tabindex="0" class="btn mr-2">Filter</label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                <li><a>Item 1</a></li>
                                <li><a>Item 2</a></li>
                            </ul>
                        </div>
                        <button class="btn" @click="reset">Reset</button>
                    </div>
                    <div class="flex w-full max-w-xs items-center md:justify-end justify-between">
                        <div class="w-3/8">
                            <label class="label block">
                                <span class="label-text">Result per Page</span>
                            </label>
                        </div>
                        <div class="w-5/8">
                            <select class="select select-bordered w-full max-w-xs" v-model="form.perPage">
                                <option v-for="option in perPageOption" :key="option" :value="option">
                                    {{option}}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <!-- <table class="table w-full">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center" @click="setOrderBy('sku')">SKU
                                    <span class="float-right">
                                        <faicon icon="arrow-up" v-if="form.sort=='sku' && form.direction=='asc'"/>
                                        <faicon icon="arrow-down" v-if="form.sort=='sku' && form.direction=='desc'"/>
                                    </span>
                                </th>
                                <th @click="setOrderBy('name')">Name
                                    <span class="float-right">
                                        <faicon icon="arrow-up" v-if="form.sort=='name' && form.direction=='asc'"/>
                                        <faicon icon="arrow-down" v-if="form.sort=='name' && form.direction=='desc'"/>
                                    </span>
                                </th>
                                <th class="text-center" @click="setOrderBy('quantity')">Quantity
                                    <span class="float-right">
                                        <faicon icon="arrow-up" v-if="form.sort=='quantity' && form.direction=='asc'"/>
                                        <faicon icon="arrow-down" v-if="form.sort=='quantity' && form.direction=='desc'"/>
                                    </span>
                                </th>
                                <th class="text-center" @click="setOrderBy('price')">Price
                                    <span class="float-right">
                                        <faicon icon="arrow-up" v-if="form.sort=='price' && form.direction=='asc'"/>
                                        <faicon icon="arrow-down" v-if="form.sort=='price' && form.direction=='desc'"/>
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
                    </table> -->
                </div>

                <div class="card-actions items-center justify-between">
                    <span>Found {{products.total}} data.</span>
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
import Table from '@/Components/Table'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import mapValues from 'lodash/mapValues'
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link,
        Table,
    },
    // layout: AppLayout,
    props: {
        filters: Object,
        products: Array,
        tableHeader: Object,
    },
    data() {
        return {
            perPageOption: [10,25,50,100],
            form: {
                search: this.filters.search,
                direction: this.filters.direction,
                sort: this.filters.sort,
                perPage: this.filters.perPage,
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
        // setOrderBy(orderBy) {
        //     this.form.direction = this.form.direction == 'asc' ? 'desc' : 'asc'
        //     this.form.sort = orderBy
        //     // this.$inertia.get(route('product'), {
        //     //     'sort': orderBy,
        //     //     'direction': this.direction
        //     // }, {
        //     //     preserveState: true
        //     // })
        // },
        reset() {
            this.form = mapValues(this.form, () => null)
            this.form.perPage = this.filters.perPage
        },
    },
}
</script>
<script setup>
    import AppLayout from '@/Layouts/AppLayout'
</script>
