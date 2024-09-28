<template>
    <div />
</template>

<script setup>
import { onBeforeUnmount, onMounted } from 'vue';
import { usePage,router } from '@inertiajs/vue3';
import { createToaster } from '@meforma/vue-toaster';

let removeFinishEventListener = null;

function handleFlashMessages() {
    let flash = usePage().props.flash;
    if (flash.info || flash.success || flash.error) {
        let type, message;
        if (flash.info) {
            type = 'info';
            message = flash.info;
        }
        if (flash.success) {
            type = 'success';
            message = flash.success;
        }
        if (flash.error) {
            type = 'error';
            message = flash.error;
        }
        const toaster = createToaster({
            position: 'bottom-right',
            useDefaultCss: true,
            maxToasts: 1,
        });
        toaster.clear();
        toaster[type](message);
    }
}

onMounted(() => {
    if(usePage().props.flash?.showToast) {
        handleFlashMessages();
    }

    removeFinishEventListener = router.on('finish', () => {
        handleFlashMessages();
    });

});

onBeforeUnmount(() => {
    removeFinishEventListener && removeFinishEventListener();
});
</script>
<style>
/* toast css */
.c-toast--info {
    background-color: #0092ef !important;
}
</style>
