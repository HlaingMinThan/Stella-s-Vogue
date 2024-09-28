<script setup>
import LineChart from '@/Components/Atoms/LineChart.vue';

const props=defineProps({
    revenueBreakdown:{
        type:Object,
        required:true
    }});

const datasets = [
    {
        label: 'Current Year Revenue',
        data: props.revenueBreakdown?.current_year?.amount,
        borderColor: 'rgba(66, 165, 245, 1)',
        backgroundColor: 'rgba(66, 165, 245, 0.2)',
        fill: true,
        tension: 0.4,
    },
    {
        label: 'Previous Year Revenue',
        data: props.revenueBreakdown?.last_year?.amount,
        borderColor: 'rgba(255, 167, 38, 1)',
        backgroundColor: 'rgba(255, 167, 38, 0.2)',
        fill: true,
        tension: 0.4,
    },
];
</script>

<template>
    <div class="border bg-white p-5 rounded-md shadow-sm">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-lg mb-5">Revenue Breakdown</h3>
        </div>

        <div>
            <LineChart id="revenue-breakdown" :data-label="revenueBreakdown?.current_year?.months" :datasets="datasets" />
        </div>
    </div>
</template>
