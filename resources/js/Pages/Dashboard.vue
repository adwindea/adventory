<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Dashboard
                </h2>
            </div>
        </template>

        <div class="card w-full bg-white dark:bg-dark-eval-1 shadow-xl">
            <!-- <figure><img src="https://api.lorem.space/image/shoes?w=400&h=225" alt="Shoes" /></figure> -->
            <div class="card-body">
                <h2 class="card-title">TES!</h2>
                <p>Iki dashboard</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-primary">Tes</button>
                </div>
            </div>
        </div>

        <!-- <div class="py-1">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8"> -->
                <!-- <div class="overflow-hidden shadow-xl sm:rounded-lg"> -->
                    <!-- Iki dashboard -->
                <!-- </div> -->
            <!-- </div>
        </div> -->
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
</script>
