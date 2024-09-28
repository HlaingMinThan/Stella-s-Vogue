<template>
    <div class="bg-gray-50">
        <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
            <div class="max-w-md w-full">
                <div class="p-8 rounded-2xl bg-white shadow">
                    <h2 class="text-gray-800 text-center text-2xl font-bold">Stella Vogue POS System</h2>
                    <form class="mt-8 space-y-4" @submit.prevent="submit">
                        <div>
                            <Label for="email" label="Email" required />
                            <div class="relative flex items-center">
                                <InputField name="email" type="text" v-model="form.email" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md" placeholder="Enter user name" />
                            </div>
                            <ValidationError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <Label for="password" label="Password" required />
                            <div class="relative flex items-center">
                                <InputField name="password" type="password" v-model="form.password" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md" placeholder="Enter password" />
                            </div>
                            <ValidationError class="mt-2" :message="form.errors.password" />
                        </div>
                        <div class="!mt-8 flex justify-end">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }"
                                           :disabled="form.processing" class="py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                                Sign in
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Label from '@/Components/Atoms/Label.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputField from '@/Components/Atoms/InputField.vue';
import ValidationError from '@/Components/Atoms/ValidationError.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('admin.login.store'));
};
</script>

<style >
/* Your styles here */
</style>
