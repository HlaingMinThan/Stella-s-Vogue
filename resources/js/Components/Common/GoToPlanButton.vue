<script setup>
import InertiaLinkButton from '@/Components/Atoms/InertiaLinkButton.vue';

defineProps({
    text:{
        type:String,
        default:'Learn More'
    },
    personal:{
        type:Boolean,
        default:true
    }
});
</script>

<template>
    <InertiaLinkButton
        :href="personal ? route('personal-plan.converage-and-pricing'):route('business-plan.converage-and-pricing')"
        class="bg-primary text-white !px-6 !py-3.5 !text-[1.05rem]">
        {{ personal ? 'View Personal Plan' : 'View Business Plan' }}
        <i class="fa-solid fa-arrow-right ml-2"></i>
    </InertiaLinkButton>
</template>
