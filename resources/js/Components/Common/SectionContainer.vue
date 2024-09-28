<template>
    <div
        class="xl:px-16 py-16"
        :class="[removePaddingInMobile ? 'px-0' : 'px-6']"
    >
        <slot />
    </div>
</template>

<script>
export default {
    props: {
        removePaddingInMobile: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
