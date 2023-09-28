<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import VirtuesList from '@/Pages/Virtues/Index.vue'; 
import CreateVirtue from '@/Pages/Virtues/Create.vue'; 
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    virtues: {
        type: Array,
    },
    message: {
        type: String,
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
        <div 
        v-if="message" 
        @click="() => message = null" 
        class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded relative text-center"
        >
            <span class="">{{ message }} (Tap to dismiss)</span>
        </div>

        <div 
        v-if="!message"  
        class="border border-transparent px-4 py-3 rounded relative"
        >
            <span class="block sm:inline">&nbsp</span>
        </div>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-10">
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
