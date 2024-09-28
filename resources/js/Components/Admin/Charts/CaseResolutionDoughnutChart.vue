<script setup>
import DoughnutChart from '@/Components/Atoms/DoughnutChart.vue';

const datasets = [
    {
        data: [100, 75, 25],
        backgroundColor: [
            'rgba(26, 225, 32, 0.9)',
            'rgba(66, 165, 245, 0.9)',
            'rgba(255, 167, 38, 0.9)',
        ],
        borderColor: [
            'rgba(26, 225, 32, 1)',
            'rgba(66, 165, 245, 1)',
            'rgba(255, 167, 38, 1)',
        ],
        borderWidth: 1,
    },
];
</script>

<template>
    <div class="border bg-white p-5 rounded-md shadow-sm">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-lg mb-5">Case Resolution ( April )</h3>
        </div>

        <div>
            <DoughnutChart id="case-resolution" :datasets="datasets" />
        </div>
    </div>
</template>
