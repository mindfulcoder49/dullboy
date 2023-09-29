<template>
    <div>
      <div class="flex flex-wrap justify-center">
        
        <VirtuesEdit :virtue="virtue" v-for="virtue in virtues" :key="virtue.id" class="w-1/5 min-w-[100px] m-2" :class="{ 'bg-blue-100': !virtue.harmful, 'bg-red-100' : virtue.harmful }" :virtueName="virtueName" :message="message" />
          <!--
          <div class="flex-column justify-between items-center p-1 m-2 rounded-lg shadow w-1/4 float-left" :class="{ 'bg-blue-50': !virtue.harmful, 'bg-red-50' : virtue.harmful }">
          <div class="text-blue-900 m-3">{{ virtue.count }}</div>
          </div> 
            <VirtuesEdit :virtue="virtue" /> 
        </div> -->
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
      message: {
        type: String,
      },
      virtueName: {
        type: String,
      },
    },
    components: {
      VirtuesEdit, // Register your VirtuesEdit component
    },
  };
  </script>
  