<script setup>
defineProps({
    label: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <li>
        <div class="flex items-center">
            <i class="fa-solid fa-angle-right text-darkGray"></i>
            <div class="ml-1 text-sm font-semibold text-darkGray  md:ml-2">
                {{ label }}
            </div>
        </div>
    </li>
</template>
