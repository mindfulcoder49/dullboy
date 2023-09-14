<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import VirtuesList from '@/Pages/Virtues/Index.vue'; // Assuming you have this component
import CreateVirtue from '@/Pages/Virtues/Create.vue'; // Assuming you have this component

defineProps({
    virtues: {
        type: Array,
    },
});
</script>

<template>
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

                    <!-- Provide a link or button to create a new virtue -->
                    <CreateVirtue />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
