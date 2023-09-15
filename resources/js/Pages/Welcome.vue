<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
  <Head title="Welcome to Vice and Virtue Health Coach" />
  <div class="bg-blue-100 h-screen flex flex-col justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-3/4 md:w-1/2">
      <h1 class="text-3xl text-blue-800 mb-4">Welcome to Vice and Virtue Health Coach</h1>
      <p class="text-gray-700 mb-4">
        Here, we employ the finest psychological techniques to help you increase your virtues and reduce your vices.
      </p>
      <p class="text-gray-700 mb-6">
        Take control of your life by making meaningful changes. Become the person you always aspired to be.
      </p>
      <div class="flex justify-between">
        <Link
          v-if="canLogin"
          href="/login"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Login
        </Link>
        <Link
          v-if="canRegister"
          href="/register"
          class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Register to Start Your Journey
        </Link>
      </div>
    </div>
  </div>
</template>

<style>
  /* Add any custom styles here */
</style>
