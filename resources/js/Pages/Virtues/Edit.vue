<template>
  <div class="p-1 relative rounded-lg shadow-lg min-width-[100px]" :class="{'bg-blue-100': !virtue.harmful, 'bg-red-100': virtue.harmful, 'spin-fast-vice': isSpinning && virtue.harmful, 'spin-fast-virtue' : isSpinning && !virtue.harmful}">
    <!--
    <h2 v-if="!virtue.harmful" class="text-2xl font-semibold text-blue-800 mb-2">Edit Virtue</h2>
    <h2 v-if="virtue.harmful" class="text-2xl font-semibold text-red-800 mb-2">Edit Vice</h2> -->

    <div 
    v-if="message && virtueName == virtue.name" 
    @click="() => message = null" 
    class="px-1 py-1 rounded absolute inset-0 mx-auto text-center font-semibold pulsating-gradient flash-message"
    >{{ message }}
    </div>

    <form @submit.prevent="updateVirtue"
        >
      <!-- Add form fields for virtue editing -->
      <div class="mb-2"> <!--
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label> -->
      <textarea 
        ref="nameInput"
        :rows="this.rows" 
        @focus="openForEdit()" 
        class="transition-all duration-300 ease-in-out w-full shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:py-0 focus:px-1 scroll-none text-center" 
        >{{ virtue.name }}</textarea>

      </div>
      <div class="mb-2"> 
        <!-- a close editor button that invokes closeForEdit -->
        <button
            v-if="this.rows==3"
            type="button"
            @click="closeForEdit"
            class="text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline"
            :class="{ 'bg-blue-500': !virtue.harmful, 'bg-red-500' : virtue.harmful }"
          >
            Close
          </button>
        </div>
        

      <!-- Buttons to increment/decrement count -->
      <div class="mb-2"> 

          <button
            type="button"
            @click="incrementCount"
            class="text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline w-full"
            :class="{ 'bg-blue-500': !virtue.harmful, 'bg-red-500' : virtue.harmful }"
          >
           {{ virtue.count }}
          </button>
      </div>

      <!-- Buttons to increment/decrement timeinterval 
      <div class="mb-2">
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
            v-model="virtue.timeinterval"
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
      -->

    <!-- Add a dropdown for harmful -->
    <div class="mb-2" ref="editDiv" v-if="this.rows==3">
      <!--
      <label for="harmful" class="inline-block text-gray-700 text-sm font-bold mb-2 pb-2 pr-2">Vice or Virtue?</label> -->
      <button
            type="button"
            @click="decrementCount"
            class=" text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline"
            :class="{ 'bg-blue-500': virtue.harmful, 'bg-red-500' : !virtue.harmful }"
          >
            -
          </button>
          
      <select
        ref="harmful"
        v-model="virtue.harmful"
        class="inline shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-2/3"
      >
        <option :value="0">Virtue</option>
        <option :value="1">Vice</option>
      </select>
              <!-- Add the delete button here -->
      <button
        ref="deleteButton"
        type="button"
        @click="deleteVirtue"
        class="block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 m-2 rounded focus:outline-none focus:shadow-outline"
        
      >
        Delete
      </button>
      <button
        type="button"
        class="block bg-blue-500 hover:bg-blue-7  00 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        ref="updateButton"
        @click="updateVirtue"
      > 
        Update
      </button>
      </div>  

    </form>
  </div>
</template>

<script>
export default {
  props: {
    virtue: {
        type: Object,
      },
      message: {
        type: String,
      },
      virtueName: {
        type: String,
      },
  },
  data () {
    return {
      rows: 1,
      isSpinning: false,
    }
  },
  methods: {
    updateVirtue() {
      this.virtue.name = this.$refs.nameInput.value;
      this.$inertia.put(`/dashboard`, this.virtue, {
        preserveScroll: true,
        onSuccess: () => {
          // You can add any success actions here, like showing a notification
          //preserve the scroll

        },
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
      this.virtue.count = parseInt(this.virtue.count) + 1;
      this.isSpinning = true;

      setTimeout(() => {
        this.updateVirtue();
        setTimeout(() => { this.isSpinning = false;} , 400);
      }, 1100);
    },
    decrementCount() {
      // Decrement the count field by 1
      this.virtue.count = parseInt(this.virtue.count) - 1;
      this.updateVirtue();
    },
    incrementTime() {
      // Increment the timeinterval field by 15
      this.virtue.timeinterval = parseInt(this.virtue.timeinterval) + 15;
    },
    decrementTime() {
      // Decrement the timeinterval field by 15
      this.virtue.timeinterval = parseInt(this.virtue.timeinterval) - 15;
    },
    openForEdit() {
      this.rows = 3;
    },
    closeForEdit() {
      this.rows = 1;
    }
  },
};
</script>

<style scoped>
/* Add this to your styles */
.spin-fast-virtue {
  animation: spinvirtue .75s linear infinite;
}

.spin-fast-vice {
  animation: spinvice .75s linear infinite;
}

.flash-message {
  animation: flash 1s linear infinite;
}

@keyframes spinvice {
  0% { 
    transform: rotate(0deg); 
  }
  25% {
    background: #f09b74;
    opacity: .5;
    transform:rotate(20deg);

  }
  50% {
    background: #dd8f8c;
    opacity: .9;
   }
   75% {
    background: #ffb656;
    opacity: .5;
    transform:rotate(-20deg);
  }
  100% { 
    transform: rotate(0deg);
  }
}

@keyframes spinvirtue {
  0% { 
    transform: rotate(0deg);
  }
  25% {
    background: #93f7b4;
    opacity: .9;
    transform: rotate(20deg);
  }
  50% {
    background: #6eca6e;
    opacity: .5;
   }
   75% {
    background: #93f7ea;
    opacity: .9;
    transform: rotate(-20deg);
  }
  100% { 
    transform: rotate(0deg);
  }
}

.pulsating-gradient {
  background: linear-gradient(to right, #f5f2f2, rgba(255, 254, 219, 0.9), #faf2f2b2, #f5f2f2);

  background-size: 300% 300%;
  background-position: 100% 50%;
  animation: pulse 5s ease-in-out infinite;
  box-shadow: 0 0 100px 5px rgba(255, 238, 0, 0.425); /* Blue halo */
  overflow: visible;
}
.pulsating-gradient:before {
  content: "";
  display: block;
  padding-top: 15%;
}

@keyframes pulse {
  0% {
    background-position: 200% 50%;
    opacity: 1;
  }
  50% {
    background-position: 100% 50%;
    opacity: .9;
  }
  100% {
    background-position: 200% 50%;
    opacity: 1;
  }
}


</style>