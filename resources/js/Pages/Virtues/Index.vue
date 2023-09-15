<template>
    <div>
      <div class="">
        
        <div v-for="virtue in virtues" :key="virtue.id" class="flex justify-between items-center  p-1 mb-2 rounded-lg shadow w-1/3 min-w-[300px] float-left" :class="{ 'bg-blue-100': !virtue.harmful, 'bg-red-100' : virtue.harmful }">
          <div class="flex-column justify-between items-center p-1 mb-2 rounded-lg shadow w-1/3 float-left" :class="{ 'bg-blue-50': !virtue.harmful, 'bg-red-50' : virtue.harmful }">
          <div class="text-blue-900 m-4">Name: {{ virtue.name }}</div>
          <div class="text-blue-900 m-4">Count: {{ virtue.count }}</div>
          <div class="text-blue-900 m-4">Time: {{ virtue.timeinterval }}</div>
          <div class="text-blue-900 m-4">Harm: {{ virtue.harmful }}</div>
          </div>
          <div class="">
            <VirtuesEdit :virtue="virtue" />
          </div>
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
  