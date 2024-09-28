<script setup>
import { ref, watch, computed } from 'vue';
import { emitter } from '@/Helpers/emitter';
import { usePage } from '@inertiajs/vue3';
import Modal from '@/Pages/Auth/Steps/Components/Modal.vue';

const isOpen = ref(false);
const type = ref('Personal');

const closeModal = () => isOpen.value = false;

emitter.on('open-plan-details-dialog', (item) => {
    isOpen.value = true;
    type.value = item.type;
});

watch(isOpen, (newValue) => {
    if (newValue) {
        document.body.classList.add('overflow-hidden');
    } else {
        document.body.classList.remove('overflow-hidden');
    }
});

const planDetails = computed(() => {
    if (type.value === 'Personal') {
        return usePage().props.planDetails?.personalPlan;
    } else {
        return usePage().props.planDetails?.businessPlan;
    }
});
</script>

<template>
    <Modal :open="isOpen" @closeModal="closeModal">
        <!-- Adjust max-width for the modal -->
        <div class="bg-white p-8 max-w-sm sm:max-w-md md:max-w-lg lg:max-w-2xl xl:max-w-3xl w-full relative rounded-lg">
            <button @click="closeModal" class="absolute top-2.5 right-2.5 p-1 text-gray-500 hover:text-gray-800 transition">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-darkGray mt-8">
                <h2 class="text-lg sm:text-2xl font-semibold mb-4 text-center text-primary">
                    Thai Legal Protection Co., Ltd. (TLP) {{ type }} Plan Membership Details
                </h2>

                <div v-html="planDetails" class="max-w-3xl prose"></div>
            </div>
        </div>
    </Modal>
</template>
