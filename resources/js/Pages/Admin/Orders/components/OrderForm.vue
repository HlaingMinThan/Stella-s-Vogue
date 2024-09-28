<template>
    <div>
        <form @submit.prevent="submitForm">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required
                    />
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                    <input
                        v-model="form.color"
                        type="text"
                        id="color"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required
                    />
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input
                        v-model="form.address"
                        type="text"
                        id="address"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required
                    />
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input
                        v-model="form.phone"
                        type="text"
                        id="phone"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required
                    />
                </div>

                <div>
                    <label for="payment" class="block text-sm font-medium text-gray-700">Payment Option</label>
                    <input
                        v-model="form.payment"
                        type="text"
                        id="payment"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required
                    />
                </div>

                <div>
                    <label for="screenshot" class="block text-sm font-medium text-gray-700">Screenshot (Optional)</label>
                    <input
                        @change="form.screenshot = $event.target.files[0]"
                        type="file"
                        id="screenshot"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                    />
                </div>

                <div>
                    <label for="delivery_id" class="block text-sm font-medium text-gray-700">Delivery ID</label>
                    <input
                        v-model="form.delivery_id"
                        type="number"
                        id="delivery_id"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required
                    />
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <input
                        v-model="form.notes"
                        type="text"
                        id="notes"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                    />
                </div>

                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input
                        v-model="form.amount"
                        type="number"
                        id="amount"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required
                    />
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    {{ isEditMode ? 'Update Order' : 'Create Order' }}
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
                color: '',
                address: '',
                phone: '',
                payment: '',
                screenshot: null,
                delivery_id: null,
                notes: '',
                amount: 0,
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
        };
    },
    methods: {
        async submitForm() {
            const routeName = this.isEditMode ? 'admin.orders.update' : 'admin.orders.store';
            const method = this.isEditMode ? 'put' : 'post';
            const formData = new FormData();

            // Append all form fields to FormData
            for (const key in this.form) {
                formData.append(key, this.form[key]);
            }

            // Submit the form using Inertia
            await this.$inertia[method](route(routeName, { order: this.isEditMode ? this.initialForm.id : null }), formData);
        },
    },
};
</script>

<style scoped>
/* Add custom styles here */
</style>
