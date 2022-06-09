<template>
    <AppLayout title="Products">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Products
                </h2>
            </div>
        </template>

        <div class="card w-full bg-white dark:bg-dark-eval-1 shadow-xl">
            <div class="card-body">

            </div>
        </div>

    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        // AppLayout,
    },
    layout: AppLayout,
    // props: {
    //     filters: Object,
    //     users: Array,
    // },
    data() {
        return {
        // form: {
        //     search: this.filters.search,
        //     role: this.filters.role,
        //     trashed: this.filters.trashed,
        // },
        }
    },
    // watch: {
    //     form: {
    //     deep: true,
    //     handler: throttle(function () {
    //         this.$inertia.get('/users', pickBy(this.form), { preserveState: true })
    //     }, 150),
    //     },
    // },
    methods: {
        // reset() {
        // this.form = mapValues(this.form, () => null)
        // },
    },
}
</script>
