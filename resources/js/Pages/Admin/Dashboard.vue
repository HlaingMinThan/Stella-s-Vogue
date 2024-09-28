<script setup>
import {computed,ref,watch,reactive} from 'vue';
import DashboardHeaderStats from '@/Components/Organisms/DashboardHeaderStats.vue';
import Datepicker from '@/Components/Atoms/Datepicker.vue';
import { Head,router,Link,usePage } from '@inertiajs/vue3';

const props=defineProps({
    stats:{
        type:Object,
        required:true
    },
    charts:{
        type:Object,
        required:true
    }
});

const date=ref(null);

const query=reactive({
    date_from:usePage().props.ziggy?.query?.date_from,
    date_until:usePage().props.ziggy?.query?.date_until,
});


const formatDate = (date) => {
    const d = new Date(date);
    return d.toISOString().split('T')[0];
};

const dateFrom = computed(() => date.value?.length && date.value[0] ? formatDate(date.value[0]) : null);
const dateUntil = computed(() => date.value?.length && date.value[1] ? formatDate(date.value[1]) : null);

watch(date,()=>{
    if(dateFrom.value&&dateUntil.value){
        router.get(route('admin.dashboard'),{
            date_from:dateFrom.value,
            date_until:dateUntil.value
        });
    }else{
        router.get(route('admin.dashboard'));
    }
});

</script>

<template>
    <Head title="Admin Dashboard" />
    <div class="min-h-screen bg-white">
        <!-- Header Stats -->
        <div>
            <DashboardHeaderStats :stats="stats" />
        </div>

        <!-- tables -->
        
    </div>
</template>
