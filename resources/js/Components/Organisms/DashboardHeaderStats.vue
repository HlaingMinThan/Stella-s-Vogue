<script setup>
import { computed } from "vue";
import DashboardCardStats from "@/Components/Atoms/DashboardCardStats.vue";

const props = defineProps({
    stats: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="bg-gray-100">
        <div class="px-4 md:px-6 mx-auto w-full py-8">
            <div class="grid grid-cols-1 md:grid-cols-2  gap-5">
                <div>
                    <DashboardCardStats
                        stat-subtitle="Today Total Ways"
                        :statTitle="stats.total_today_ways"
                        stat-icon-color="bg-red-500"
                    />
                </div>
                <div>
                    <DashboardCardStats
                        stat-subtitle="Today Order Income"
                        :statTitle="stats.total_today_order_income"
                        stat-icon-color="bg-pink-500"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
