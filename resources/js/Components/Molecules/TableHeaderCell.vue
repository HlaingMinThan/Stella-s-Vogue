<script setup>
defineProps({
    label: {
        type: String,
        required: true
    }
});
</script>

<template>
    <th scope="col" class="px-6 py-3 ">
        <span class="md:line-clamp-1 capitalize  py-10 md:p-1.5">
            {{ label }}
        </span>
    </th>
</template>
