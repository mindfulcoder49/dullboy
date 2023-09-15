<template>
  <div class="p-4 rounded-lg shadow-lg" :class="{'bg-blue-100': !virtue.harmful, 'bg-red-100': virtue.harmful}">
    <h2 v-if="!virtue.harmful" class="text-2xl font-semibold text-blue-800 mb-4">Edit Virtue</h2>
    <h2 v-if="virtue.harmful" class="text-2xl font-semibold text-red-800 mb-4">Edit Vice</h2>

    <form @submit.prevent="updateVirtue">
      <!-- Add form fields for virtue editing -->
      <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
        <input
          type="text"
          id="name"
          v-model="form.name"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        >
      </div>
        

      <!-- Buttons to increment/decrement count -->
      <div class="mb-4">
        <label for="count" class="block text-gray-700 text-sm font-bold mb-2">Count:</label>
        <div class="flex items-center">
          <button
            type="button"
            @click="decrementCount"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-l focus:outline-none focus:shadow-outline"
          >
            -1
          </button>
          <input
            type="text"
            id="count"
            v-model="form.count"
            class="shadow appearance-none border border-r-0 rounded-r w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          >
          <button
            type="button"
            @click="incrementCount"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-r focus:outline-none focus:shadow-outline"
          >
            +1
          </button>
        </div>
      </div>

      <!-- Buttons to increment/decrement timeinterval -->
      <div class="mb-4">
        <label for="time" class="block text-gray-700 text-sm font-bold mb-2">Time Interval:</label>
        <div class="flex items-center">
          <button
            type="button"
            @click="decrementTime"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-l focus:outline-none focus:shadow-outline"
          >
            -15
          </button>
          <input
            type="text"
            id="time"
            v-model="form.timeinterval"
            class="shadow appearance-none border border-r-0 rounded-r w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          >
          <button
            type="button"
            @click="incrementTime"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-r focus:outline-none focus:shadow-outline"
          >
            +15
          </button>
        </div>
      </div>

      <!-- Add a checkbox for harmful -->
      <div class="mb-4">
        <label for="harmful" class="block text-gray-700 text-sm font-bold mb-2">Bad Habit?</label>
        <input
          type="checkbox"
          id="harmful"
          v-model="form.harmful"
          :checked="form.harmful"
          class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
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
        name: this.virtue.name,
        count: this.virtue.count,
        timeinterval: this.virtue.timeinterval,
        harmful: this.virtue.harmful,
      }),
    };
  },
  methods: {
    updateVirtue() {
      this.form.put(`/virtues/${this.virtue.id}`, {
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
    incrementCount() {
      // Increment the count field by 1
      this.form.count = parseInt(this.form.count) + 1;
    },
    decrementCount() {
      // Decrement the count field by 1
      this.form.count = parseInt(this.form.count) - 1;
    },
    incrementTime() {
      // Increment the timeinterval field by 15
      this.form.timeinterval = parseInt(this.form.timeinterval) + 15;
    },
    decrementTime() {
      // Decrement the timeinterval field by 15
      this.form.timeinterval = parseInt(this.form.timeinterval) - 15;
    },
  },
};
</script>
