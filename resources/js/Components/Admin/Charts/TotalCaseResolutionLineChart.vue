<script setup>
import LineChart from '@/Components/Atoms/LineChart.vue';

const datasets = [
    {
        label: `${new Date().getFullYear()} Cases`,
        data: [50, 60, 40, 60, 90, 100, 110, 80, 130, 120, 150, 160],
        borderColor: 'rgba(235, 87, 87, 1)',
        backgroundColor: 'rgba(235, 87, 87, 0.2)',
        fill: true,
        tension: 0.4,
    },
    {
        label: `${new Date().getFullYear() - 1} Previous Year Cases`,
        data: [140, 150, 60, 170, 80, 90, 10, 110, 10, 130, 140, 150],
        borderColor: 'rgba(0, 173, 181, 1)',
        backgroundColor: 'rgba(0, 173, 181, 0.2)',
        fill: true,
        tension: 0.4,
    }
];
</script>


<template>
    <div class="border bg-white p-5 rounded-md shadow-sm">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-lg mb-5">Case Performance</h3>
        </div>

        <div>
            <LineChart id="total-cases" :datasets="datasets" />
        </div>
    </div>
</template>
