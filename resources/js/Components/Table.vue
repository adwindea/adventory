<template>
    <div class="card-title flex-wrap justify-between">
        <div class="flex-wrap w-full max-w-lg">
            <input type="text" placeholder="Type to search" v-model="form.search" class="input input-bordered w-full max-w-xs mr-2 mb-2" />
            <div v-if="customFilter !== undefined" class="dropdown dropdown-right">
                <label tabindex="0" class="btn btn-primary mr-2">Filter</label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li v-for="custom in customFilter" :key="custom">
                        <select v-if="custom.type == 'select'" class="select select-bordered w-full max-w-xs" :placeholder="custom.title">
                            <option value=""></option>
                            <option v-for="option in custom.options" :key="option" :value="option.value">
                                {{option.text}}
                            </option>
                        </select>
                    </li>
                </ul>
            </div>
            <button class="btn btn-ghost" @click="reset">Reset</button>
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
        <table class="table w-full">
            <thead>
                <tr>
                    <th v-for="head in header" :key="head.value" :class="head.class" v-on="head.sortable ? { click : () => setOrderBy(head.value) } : {click: ($event) => $event.preventDefault() }">
                        {{ head.text }}
                        <span class="float-right" v-if="head.sortable">
                            <faicon icon="arrow-up" v-if="form.sort==head.value && form.direction=='asc'"/>
                            <faicon icon="arrow-down" v-if="form.sort==head.value && form.direction=='desc'"/>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product) in products.data" :key="product.xid">
                    <td v-for="head in header" :key="head.value" :class="head.class">{{product[head.value]}}</td>
                </tr>
                <tr v-if="products.data.length === 0">
                    <td class="text-center" :colspan="header.length">No products found.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-actions items-center justify-between">
        <span>Found {{products.total}} data.</span>
        <div class="btn-group">
            <Link v-for="paging in products.links" :href="paging.url" :key="paging.label"
                class="btn btn-ghost"
                :class="{'btn-active':paging.active}"
                v-html="paging.label"
            ></Link>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import throttle from 'lodash/throttle'
import pickBy from 'lodash/pickBy'
import mapValues from 'lodash/mapValues'


export default {
    components:{
        Link,
    },

    props: {
        header: Array,
        filters: Object,
        products: Object,
        dest: String,
        customFilter: Array,
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
                this.$inertia.get(this.dest, pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },

    methods: {
        setOrderBy(orderBy){
            this.form.direction = this.form.direction == 'asc' ? 'desc' : 'asc'
            this.form.sort = orderBy
        },
        reset() {
            this.form = mapValues(this.form, () => null)
            this.form.perPage = this.filters.perPage
        },
    }
}
</script>
