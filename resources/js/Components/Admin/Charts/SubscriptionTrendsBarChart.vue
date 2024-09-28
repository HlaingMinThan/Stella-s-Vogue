<script setup>
import BarChart from '@/Components/Atoms/BarChart.vue';

const props=defineProps({
    subscriptionsTrend:{
        type:Object,
        required:true
    }
});

const datasets = [
    {
        label:'Active Subscriptions',
        data: props.subscriptionsTrend?.active_subscriptions?.count,
        borderColor: 'rgba(0, 173, 181, 0.9)',
        backgroundColor: 'rgba(0, 173, 181, 1)',
        borderWidth: 1,
    },
];
</script>

<template>
    <div class="border bg-white p-5 rounded-md shadow-sm">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-lg mb-5">Active Subscriptions</h3>
        </div>

        <div>
            <BarChart id="subscription-trends" :data-label="subscriptionsTrend.active_subscriptions?.months" :datasets="datasets" />
        </div>
    </div>
</template>
