<template>
    <div class="my-3 bg-gray-100 p-5 rounded-xl">
        <form @submit.prevent="submitForm">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div v-for="(field, key) in fields" :key="key">
                    <label :for="key" class="block text-sm font-medium text-gray-700">{{ field.label }}</label>
                    <input
                        v-model="form[key]"
                        :type="field.type"
                        :id="key"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        :required="field.required"
                    />
                </div>
            </div>
  
            <div class="mt-6">
                <button type="submit" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    {{ isEditMode ? 'Update Collection' : 'Create Collection' }}
                </button>
            </div>
        </form>
    </div>
</template>
  
<script>
export default {
    props: {
        initialForm: {
            type: Object,
            default: () => ({
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
            }),
        },
        isEditMode: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            form: { ...this.initialForm },
            fields: {
                name: { label: 'Collection Name', type: 'text', required: true },
                // fabric: { label: 'Fabric Cost', type: 'number', required: true },
                // under: { label: 'Under Cost', type: 'number', required: true },
                // sample_pattern: { label: 'Sample Pattern', type: 'number', required: true },
                // sew_fees: { label: 'Sew Fees', type: 'number', required: true },
                // model_fees: { label: 'Model Fees', type: 'number', required: true },
                // model_deli_fees: { label: 'Model Delivery Fees', type: 'number', required: true },
                // boosting: { label: 'Boosting Cost', type: 'number', required: true },
                // phone_bill: { label: 'Phone Bill', type: 'number', required: true },
                // packing_fees: { label: 'Packing Fees', type: 'number', required: true },
                // extra_charges: { label: 'Extra Charges', type: 'number', required: true },
                // taxi_charges: { label: 'Taxi Charges', type: 'number', required: true },
                // ga__vlog_charges: { label: 'GA/Vlog Charges', type: 'number', required: true },
                stock: { label: 'Stock', type: 'number', required: true },
            },
        };
    },
    methods: {
        submitForm() {
            const routeName = this.isEditMode ? 'admin.collections.update' : 'admin.collections.store';
            const method = this.isEditMode ? 'put' : 'post';
            this.$inertia[method](route(routeName, { collection: this.initialForm.id }), this.form);
        },
    },
};
</script>
  
  <style scoped>
  /* Add custom styles here */
  </style>
  