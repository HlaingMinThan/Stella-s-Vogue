<script setup>
import {computed} from 'vue';
import DashboardCardStats from '@/Components/Atoms/DashboardCardStats.vue';

const props=defineProps({
    stats:{
        type:Object,
        required:true
    }
});

const newRegistrationStat = computed(() =>  props.stats.new_registrations);
const activeSubscriptionsStat = computed(() =>  props.stats.active_subscriptions);
const inActiveSubscriptionsStat = computed(() =>  props.stats.inactive_subscriptions);
const totalRevenueStat = computed(() =>  props.stats.total_revenue);

</script>

<template>
    <div class="bg-gray-100">
        <div class="px-4 md:px-6 mx-auto w-full py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <DashboardCardStats
                        stat-subtitle="New Registrations"
                        :stat-title="newRegistrationStat.value"
                        :stat-arrow="newRegistrationStat.change > 0 ? 'up' : 'down'"
                        :stat-percent="newRegistrationStat.change"
                        :stat-percent-color="newRegistrationStat.change > 0 ? 'text-green-500' : 'text-red-500'"
                        stat-description="Since last month"
                        stat-icon-name="fas fa-user-plus"
                        stat-icon-color="bg-orange-500"
                    />
                </div>

                <div>
                    <DashboardCardStats
                        stat-subtitle="Active Subscriptions"
                        :stat-title="activeSubscriptionsStat.value"
                        :stat-arrow="activeSubscriptionsStat.change > 0 ? 'up' : 'down'"
                        :stat-percent="activeSubscriptionsStat.change"
                        :stat-percent-color="activeSubscriptionsStat.change > 0 ? 'text-green-500' : 'text-red-500'"
                        stat-description="Since last month"
                        stat-icon-name="fas fa-file-contract"
                        stat-icon-color="bg-emerald-500"
                    />
                </div>

                <div>
                    <DashboardCardStats
                        stat-subtitle="Inactive Subscriptions"
                        :stat-title="inActiveSubscriptionsStat.value"
                        :stat-arrow="inActiveSubscriptionsStat.change > 0 ? 'up' : 'down'"
                        :stat-percent="inActiveSubscriptionsStat.change"
                        :stat-percent-color="inActiveSubscriptionsStat.change > 0 ? 'text-green-500' : 'text-red-500'"
                        stat-description="Since last month"
                        stat-icon-name="fas fa-file-alt"
                        stat-icon-color="bg-red-500"
                    />
                </div>

                <div>
                    <DashboardCardStats
                        stat-subtitle="Revenue"
                        :stat-title="'฿ '+totalRevenueStat.value"
                        :stat-arrow="totalRevenueStat.change > 0 ? 'up' : 'down'"
                        :stat-percent="totalRevenueStat.change"
                        :stat-percent-color="totalRevenueStat.change > 0 ? 'text-green-500' : 'text-red-500'"
                        stat-description="Since last month"
                        stat-icon-name="fas fa-sack-dollar"
                        stat-icon-color="bg-pink-500"
                    />
                </div>

                <!-- <div>
                    <DashboardCardStats
                        stat-subtitle="Customer Satisfaction"
                        stat-title="231"
                        stat-arrow="up"
                        stat-percent="23.45"
                        stat-percent-color="text-green-500"
                        stat-description="Since last month"
                        stat-icon-name="fas fa-smile"
                        stat-icon-color="bg-teal-500"
                    />
                </div> -->

                <!-- <div>
                    <DashboardCardStats
                        stat-subtitle="Total Cases"
                        stat-title="1,234"
                        stat-arrow="up"
                        stat-percent="15.2"
                        stat-percent-color="text-green-500"
                        stat-description="Since last month"
                        stat-icon-name="fas fa-briefcase"
                        stat-icon-color="bg-red-500"
                    />
                </div> -->

                <!-- <div>
                    <DashboardCardStats
                        stat-subtitle="Pending Cases"
                        stat-title="429"
                        stat-arrow="up"
                        stat-percent="23.45"
                        stat-percent-color="text-green-500"
                        stat-description="Since last month"
                        stat-icon-name="fas fa-hourglass-half"
                        stat-icon-color="bg-blue-500"
                    />
                </div> -->

                <!-- <div>
                    <DashboardCardStats
                        stat-subtitle="Resolved Cases"
                        stat-title="826"
                        stat-arrow="down"
                        stat-percent="23.45"
                        stat-percent-color="text-red-500"
                        stat-description="Since last month"
                        stat-icon-name="fas fa-balance-scale"
                        stat-icon-color="bg-yellow-500"
                    />
                </div> -->

                <!-- <div>
                    <DashboardCardStats
                        stat-subtitle="Support Tickets"
                        stat-title="142"
                        stat-arrow="up"
                        stat-percent="23.45"
                        stat-percent-color="text-green-500"
                        stat-description="Since last month"
                        stat-icon-name="fas fa-ticket-alt"
                        stat-icon-color="bg-purple-500"
                    />
                </div> -->
            </div>
        </div>
    </div>
</template>
