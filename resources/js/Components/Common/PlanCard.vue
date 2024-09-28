<script setup>
import InertiaLinkButton from '@/Components/Atoms/InertiaLinkButton.vue';

defineProps({plan:Object});
</script>

<template>
    <div class="w-full md:w-1/2 p-8 bg-white shadow-[0_4px_10px_rgba(0,0,0,0.1)] rounded-lg space-y-6 border">
        <h3 class="text-2xl font-bold text-primary">{{ plan?.name }} Plan – {{ plan?.prices[0]?.amount }} THB/month</h3>
        <ul class="list-outside list-disc space-y-3 font-medium text-darkGray pl-5">
            <li>24/7 Emergency Assistance: Call us anytime for urgent legal help.</li>
            <li>Fast Access to Lawyers: Talk to our experienced lawyers quickly, anywhere in Thailand.</li>
            <li>Full Personal Legal Protection: We help with family issues, property problems, visas, and more.</li>
            <li>Peace of Mind: Get legal advice when you need it, so you feel safe and secure.</li>
        </ul>
        <InertiaLinkButton
            :href="plan.name ==='Personal' ? route('personal-plan.converage-and-pricing') : route('business-plan.converage-and-pricing')"
            class="bg-primary text-white ml-4">
            Learn More
            <i class="fa-solid fa-arrow-right ml-2"></i>
        </InertiaLinkButton>
    </div>
</template>
