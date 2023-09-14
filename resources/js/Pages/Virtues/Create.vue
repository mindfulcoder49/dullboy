<template>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <h1 class="text-2xl font-semibold mb-4">Create a New Virtue</h1>
      <p class="text-gray-600 mb-4">Fill in the details to create a new virtue.</p>
      
      <form @submit.prevent="createVirtue">
        <div class="mb-4">
          <label for="virtueData" class="block text-gray-700 text-sm font-bold mb-2">Data:</label>
          <input
            type="text"
            id="virtueData"
            v-model="form.virtueData"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          >
          <!-- Display validation error for 'virtueData' field -->
          <div v-if="form.errors.virtueData" class="text-red-500 text-xs mt-2">{{ form.errors.virtueData }}</div>
        </div>
        
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Create
        </button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: this.$inertia.form({
          virtueData: '' // Renamed 'data' to 'virtueData'
        })
      };
    },
    methods: {
      createVirtue() {
        this.form.post('/virtues', {
          onSuccess: () => {
            this.form.reset('virtueData'); // Renamed 'data' to 'virtueData'
          }
        });
      }
    }
  }
  </script>
  