<template>
    <div class="grid grid-cols-1 md:grid-cols-2 md:space-x-10">
        <div class="w-full md:order-last rounded-2xl overflow-hidden">
            <img :src="image" alt="" />
        </div>
        <div class="w-full">
            <slot />
        </div>
    </div>
</template>
<script>
export default {
    props: {
        image: {
            type: String,
        },
    },
};
</script>
<style></style>
