<template>
    <div class="min-h-screen py-3 space-y-8">
      <div class="flex items-center justify-between">
        <!-- Breadcrumb -->
        <Breadcrumb icon="fa-box" label="Collections" :href="route('admin.collections.index')">
          <BreadcrumbItem label="Create" />
        </Breadcrumb>
      </div>
  
      <!-- Form Start -->
      <form @submit.prevent="submitForm">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
  
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Collection Name</label>
            <input v-model="form.name" type="text" id="name" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Fabric -->
          <div>
            <label for="fabric" class="block text-sm font-medium text-gray-700">Fabric Cost</label>
            <input v-model="form.fabric" type="number" id="fabric" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Under -->
          <div>
            <label for="under" class="block text-sm font-medium text-gray-700">Under Cost</label>
            <input v-model="form.under" type="number" id="under" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Sample Pattern -->
          <div>
            <label for="sample_pattern" class="block text-sm font-medium text-gray-700">Sample Pattern</label>
            <input v-model="form.sample_pattern" type="number" id="sample_pattern" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Sew Fees -->
          <div>
            <label for="sew_fees" class="block text-sm font-medium text-gray-700">Sew Fees</label>
            <input v-model="form.sew_fees" type="number" id="sew_fees" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Model Fees -->
          <div>
            <label for="model_fees" class="block text-sm font-medium text-gray-700">Model Fees</label>
            <input v-model="form.model_fees" type="number" id="model_fees" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Model Delivery Fees -->
          <div>
            <label for="model_deli_fees" class="block text-sm font-medium text-gray-700">Model Delivery Fees</label>
            <input v-model="form.model_deli_fees" type="number" id="model_deli_fees" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Boosting -->
          <div>
            <label for="boosting" class="block text-sm font-medium text-gray-700">Boosting Cost</label>
            <input v-model="form.boosting" type="number" id="boosting" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Phone Bill -->
          <div>
            <label for="phone_bill" class="block text-sm font-medium text-gray-700">Phone Bill</label>
            <input v-model="form.phone_bill" type="number" id="phone_bill" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Packing Fees -->
          <div>
            <label for="packing_fees" class="block text-sm font-medium text-gray-700">Packing Fees</label>
            <input v-model="form.packing_fees" type="number" id="packing_fees" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Extra Charges -->
          <div>
            <label for="extra_charges" class="block text-sm font-medium text-gray-700">Extra Charges</label>
            <input v-model="form.extra_charges" type="number" id="extra_charges" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Taxi Charges -->
          <div>
            <label for="taxi_charges" class="block text-sm font-medium text-gray-700">Taxi Charges</label>
            <input v-model="form.taxi_charges" type="number" id="taxi_charges" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- GA/Vlog Charges -->
          <div>
            <label for="ga__vlog_charges" class="block text-sm font-medium text-gray-700">GA/Vlog Charges</label>
            <input v-model="form.ga__vlog_charges" type="number" id="ga__vlog_charges" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
          <!-- Stock -->
          <div>
            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
            <input v-model="form.stock" type="number" id="stock" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
          </div>
  
        </div>
  
        <div class="mt-6">
          <button type="submit" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
            Create Collection
          </button>
        </div>
      </form>
      <!-- Form End -->
    </div>
  </template>
  
  <script>
  import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue';
  import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue';
  
  export default {
    data() {
      return {
        form: {
          name: '',
          fabric: 0,
          under: 0,
          sample_pattern: 0,
          sew_fees: 0,
          model_fees: 0,
          model_deli_fees: 0,
          boosting: 0,
          phone_bill: 0,
          packing_fees: 0,
          extra_charges: 0,
          taxi_charges: 0,
          ga__vlog_charges: 0,
          stock: 0,
        },
      };
    },
    methods: {
      submitForm() {
        this.$inertia.post(route('admin.collections.store'), this.form);
      },
    },
    components: {
      Breadcrumb,
      BreadcrumbItem,
    },
  };
  </script>
  
  <style scoped>
  /* Add your custom styles here */
  </style>
  