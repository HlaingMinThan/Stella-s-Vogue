<script setup>
import LineChart from '@/Components/Atoms/LineChart.vue';

const props=defineProps({
    registrationsOverTime:{
        type:Object,
        required:true
    }
}
);

const datasets = [
    {
        label:'New Registrations',
        data: props.registrationsOverTime.current_year.count,
        borderColor: 'rgba(0, 123, 255, 1)',
        backgroundColor: 'rgba(0, 123, 255, 0.2)',
        fill: true,
        tension: 0,
    },
];
</script>

<template>
    <div class="border bg-white p-5 rounded-md shadow-sm">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-lg mb-5">Registrations Over Time</h3>
        </div>

        <div>
            <LineChart id="registration-over-time" :data-label="registrationsOverTime.current_year.months" :datasets="datasets" />
        </div>
    </div>
</template>
