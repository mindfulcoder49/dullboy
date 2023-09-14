<template>
    <div class="bg-blue-100 p-4 rounded-lg shadow-lg">
      <h2 class="text-2xl font-semibold text-blue-800 mb-4">Edit Virtue</h2>
      <p class="text-gray-600 mb-4">Modify the details of the selected virtue.</p>
  
      <form @submit.prevent="updateVirtue">
        <!-- Add form fields for virtue editing -->
        <div class="mb-4">
          <label for="data" class="block text-gray-700 text-sm font-bold mb-2">Data:</label>
          <input
            type="text"
            id="data"
            v-model="form.virtueData" 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          >
        </div>
  
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Update
        </button>

            <!-- Add the delete button here -->
        <button
        type="button"
        @click="deleteVirtue"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2"
        >
        Delete
        </button>
        
        <div v-if="form.errors.data" class="text-red-500 text-xs mt-2">{{ form.errors.data }}</div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      virtue: Object,
    },
    data() {
      return {
        form: this.$inertia.form({
          virtueData: this.virtue.data, // Bind to form.data
        }),
      };
    },
    methods: {
        updateVirtue() {
            this.form.put(`/virtues/${this.virtue.id}`, {
            virtueData: this.form.virtueData, // Send the data field from the form
            onSuccess: () => {
                // You can add any success actions here, like showing a notification
            },
            }, {
            // Use preserveScroll option here
            preserveScroll: true,
            });
        },
      deleteVirtue() {
        if (confirm('Are you sure you want to delete this virtue?')) {
            // Perform the deletion here and navigate to a suitable route after deletion.
            // You can use this.virtue.id to identify the virtue to delete.

            // Example using Inertia.js and Laravel:
            this.$inertia.delete(`/virtues/${this.virtue.id}`, {
            onSuccess: () => {
                // Redirect or perform any actions after successful deletion.
            },
            });
        }
      },
    },
  };
  </script>
  