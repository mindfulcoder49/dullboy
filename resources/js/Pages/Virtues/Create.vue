<template>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 clear-left">
      <h1 class="text-2xl font-semibold mb-4">Create a New Virtue</h1>
      <p class="text-gray-600 mb-4">Fill in the details to create a new virtue.</p>
      
      <form @submit.prevent="createVirtue">
        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
          <input
            type="text"
            id="name"
            v-model="form.name"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          >
          <!-- Display validation error for 'name' field -->
          <div v-if="form.errors.name" class="text-red-500 text-xs mt-2">{{ form.errors.name }}</div>
        </div>

        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Bad Habit?</label>
          <input
            type="checkbox"
            id="harmful"
            v-model="form.harmful"
            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          >
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
          name: '',
          count: 1,
          timeinterval: 0,
          harmful: 0,
        }),
      };
    },
    methods: {
      createVirtue() {
        this.form.post('/virtues', {
          onSuccess: () => {
            
          }
        });
      }
    }
  }
  </script>
  