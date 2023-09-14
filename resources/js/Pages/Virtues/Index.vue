<template>
    <div>
      <div class="bg-blue-100 p-4 rounded-lg shadow-lg m-4 ">
        <h2 class="text-2xl font-semibold text-blue-800 mb-4">Your Virtues</h2>
        <p class="text-gray-600 mb-4">List of virtues.</p>
        
        <div v-for="virtue in virtues" :key="virtue.id" class="flex justify-between items-center bg-white p-1 mb-2 rounded-lg shadow w-1/2 float-left">
          <div class="text-blue-900 m-4">{{ virtue.data }}</div>
          <VirtuesEdit :virtue="virtue" />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import VirtuesEdit from '@/Pages/Virtues/Edit.vue'; // Import your VirtuesEdit component
  
  export default {
    props: {
      virtues: {
        type: Array,
        required: true,
      },
    },
    components: {
      VirtuesEdit, // Register your VirtuesEdit component
    },
  };
  </script>
  