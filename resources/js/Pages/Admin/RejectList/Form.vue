<script setup>
import { useForm } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import NormalButton from '@/Components/Atoms/NormalButton.vue'
import Breadcrumb from '@/Components/Molecules/Breadcrumb.vue'
import BreadcrumbItem from '@/Components/Atoms/BreadcrumbItem.vue'
import Datepicker from '@/Components/Atoms/Datepicker.vue'
import SelectBox from '@/Components/Atoms/SelectBox.vue'

const props = defineProps({
    reject_list: {
        type: Object,
        default: () => ({})
    },
    collections: {
        type: Array,
        default: () => []
    }
})
const form = useForm({
    customer_name: props.reject_list?.customer_name ?? '',
    collection_id: props.reject_list?.collection_id ?? '',
    color: props.reject_list?.color ?? '',
    pieces: props.reject_list?.pieces ?? 1,
    error_reason: props.reject_list?.error_reason ?? '',
    date: props.reject_list?.date ?? new Date().toISOString().split('T')[0]
})



const submit = () => {
    if (props.reject_list?.id) {
        form.put(route('admin.reject_list.update', props.reject_list.id))
    } else {
        form.post(route('admin.reject_list.store'))
    }
}
</script>

<template>
    <div class="min-h-screen py-3 space-y-8">
        <!-- Breadcrumb -->
        <div class="grid grid-cols-1">
            <Breadcrumb :icon="'fa-rotate-left'" :label="'Returns'" :href="route('admin.reject_list.index')">
                <BreadcrumbItem :label="reject_list?.id ? 'Edit' : 'Create'" />
            </Breadcrumb>
        </div>

        <!-- Form -->
        <div class="relative border border-gray-300 bg-white rounded-md shadow-sm shadow-gray-200 md:px-5 py-3">
            <form @submit.prevent="submit" class="space-y-6 p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Customer Name -->
                    <div>
                        <InputLabel for="customer_name" value="Customer Name" />
                        <TextInput
                            id="customer_name"
                            v-model="form.customer_name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError :message="form.errors.customer_name" class="mt-2" />
                    </div>

                    <!-- Collection -->
                    <div>
                        <InputLabel for="collection" value="Collection" />
                        <SelectBox
                            :selected="form.collection_id"
                            id="collection"
                            v-model="form.collection_id"
                            :options="collections"
                            :reduce="collection => String(collection.id)"
                            :get-option-label="option => option.name"
                            class="mt-1 block w-full"
                            placeholder="Select Collection"
                            required
                        />
                        <InputError :message="form.errors.collection_id" class="mt-2" />
                    </div>

                    <!-- Color -->
                    <div>
                        <InputLabel for="color" value="Color" />
                        <TextInput
                            id="color"
                            v-model="form.color"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError :message="form.errors.color" class="mt-2" />
                    </div>

                    <!-- Pieces -->
                    <div>
                        <InputLabel for="pieces" value="Pieces" />
                        <TextInput
                            id="pieces"
                            v-model="form.pieces"
                            type="number"
                            min="1"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError :message="form.errors.pieces" class="mt-2" />
                    </div>

                    <!-- Date -->
                    <div>
                        <InputLabel for="date" value="Date" />
                        <Datepicker
                            v-model="form.date"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError :message="form.errors.date" class="mt-2" />
                    </div>

                    <!-- Note -->
                    <div class="md:col-span-2">
                        <InputLabel for="Error Reason" value="Error Reason" />
                        <textarea
                            id="note"
                            v-model="form.error_reason"
                            rows="4"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        ></textarea>
                        <InputError :message="form.errors.error_reason" class="mt-2" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <NormalButton
                      type="submit"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        class="bg-primary text-white"
                    >
                        {{ reject_list?.id ? 'Update' : 'Create' }}
                    </NormalButton>
                </div>
            </form>
        </div>
    </div>
</template>