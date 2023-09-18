<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import VirtuesList from '@/Pages/Virtues/Index.vue'; 
import CreateVirtue from '@/Pages/Virtues/Create.vue'; 
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    virtues: {
        type: Array,
    },
});
</script>

<template>
    <Head>
        <title>Dashboard</title>
    </Head>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Display the user's virtues -->
                    <VirtuesList :virtues="virtues" />
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Provide a link or button to create a new virtue -->
                    <CreateVirtue />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
