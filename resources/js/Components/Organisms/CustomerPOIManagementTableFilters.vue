<script setup>
import DashboardFilterContainer from '@/Components/Common/DashboardFilterContainer.vue';
import Label from '@/Components/Atoms/Label.vue';
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import { reactive, watch, ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useQueryParams } from '@/Composables/useQueryParams';
import Checkbox from '@/Components/Atoms/Checkbox.vue';
import Datepicker from '@/Components/Atoms/Datepicker.vue';

const delayedSearch = ref(null);
const activeFiltersCount = ref(0);
const filterOptions = reactive({
    plans: usePage().props.ziggy.query?.plans,
    period: usePage().props.ziggy.query?.period,
    subscription: usePage().props.ziggy.query?.subscription,
    range: usePage().props.ziggy.query?.range,
});

const subscriptionOptions = reactive({
    active: filterOptions.subscription?.includes('active') || false,
    inactive: filterOptions.subscription?.includes('inactive') || false,
});



let props = defineProps({
    plans: Object,
    default: null,
});

const planOptions = [];
const hasOwnProperty = Object.prototype.hasOwnProperty;
for (let key in props.plans.plans) {
    if (hasOwnProperty.call(props.plans.plans, key)) {
        planOptions.push({
            label: props.plans.plans[key],
            value: props.plans.plans[key]
        });
    }
}

const { getActiveFilterQueryCount } = useQueryParams();

const getFilteredUsers = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(
            route('admin.customer-poi-management.index'),
            {
                ...usePage().props.ziggy?.query,
                plan: filterOptions.plans,
                period: filterOptions.period,
                subscription: filterOptions.subscription,
                range: filterOptions.range,
            },
            {
                replace: true,
                preserveState: true,
                onSuccess: () => {
                    activeFiltersCount.value = getActiveFilterQueryCount();
                },
            }
        );
    }, 0);
};

watch(filterOptions, () => getFilteredUsers());

onMounted(() => (activeFiltersCount.value = getActiveFilterQueryCount()));

watch(subscriptionOptions, () => {
    filterOptions.subscription = buildSubscriptionFilter();
}, { deep: true });

const buildSubscriptionFilter = () => {
    let subscriptionFilter = '';
    if (subscriptionOptions.active) {
        subscriptionFilter += 'active';
    }
    if (subscriptionOptions.inactive) {
        subscriptionFilter += subscriptionFilter ? ',inactive' : 'inactive';
    }
    return subscriptionFilter;
};
</script>

<template>
    <DashboardFilterContainer :activeFiltersCount="activeFiltersCount">

        <div>
            <Label label="Plans" />

            <SelectBox
                :selected="filterOptions.plans"
                v-model="filterOptions.plans"
                :options="planOptions"
            />
        </div>

        <div>
            <Label label="Period" />

            <SelectBox
                :selected="filterOptions.period"
                v-model="filterOptions.period"
                :options="[
                    {
                        label: 'Monthly',
                        value: 'monthly',
                    },
                    {
                        label: 'Semiannually',
                        value: 'semiannually',
                    },
                    {
                        label: 'Yearly',
                        value: 'yearly',
                    },
                ]"
            />
        </div>

        <div>
            <Label label="From Date - To Date" />

            <Datepicker   range
                          multi-calendars
                          v-model="filterOptions.range" placeholder="Select from date and to date" />
        </div>


        <div>
            <Label label="Subscription" />

            <div class="flex items-center justify-around">
                <Checkbox label="Active" v-model:checked="subscriptionOptions.active"/>
                <Checkbox label="Inactive" v-model:checked="subscriptionOptions.inactive"/>
                <!-- <Checkbox label="Cancelled" v-model:checked="subscriptionOptions.cancelled"/> -->
            </div>
        </div>
    </DashboardFilterContainer>
</template>
