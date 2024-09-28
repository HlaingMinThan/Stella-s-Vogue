<script setup>
import DashboardFilterContainer from '@/Components/Common/DashboardFilterContainer.vue';
import Label from '@/Components/Atoms/Label.vue';
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import { reactive, watch, ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useQueryParams } from '@/Composables/useQueryParams';
import Datepicker from '@/Components/Atoms/Datepicker.vue';

const delayedSearch = ref(null);
const activeFiltersCount = ref(0);
const filterOptions = reactive({
    plans: usePage().props.ziggy.query?.plans,
    status: usePage().props.ziggy.query?.status,
    payment: usePage().props.ziggy.query?.payment,
    period: usePage().props.ziggy.query?.period,
    range: usePage().props.ziggy.query?.range,
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
            route('admin.transactions.index'),
            {
                ...usePage().props.ziggy?.query,
                plan: filterOptions.plans,
                status: filterOptions.status,
                payment: filterOptions.payment,
                period: filterOptions.period,
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
</script>

<template>
    <DashboardFilterContainer :activeFiltersCount="activeFiltersCount">
        <!-- <div>
            <Label label="Payment Type" />

            <SelectBox
                :selected="filterOptions.payment"
                v-model="filterOptions.payment"
                :options="[
                    {
                        label: 'Visa',
                        value: 'visa',
                    },
                    {
                        label: 'Master Card',
                        value: 'mastercard',
                    },
                    {
                        label: 'Union Pay',
                        value: 'unionpay',
                    },
                    {
                        label: 'JCB',
                        value: 'jcb',
                    },
                    {
                        label: 'Discover',
                        value: 'discover',
                    },
                    {
                        label: 'Diners Club',
                        value: 'dinersclub',
                    },
                    {
                        label: 'American Express',
                        value: 'americanexpress',
                    },
                ]"
            />
        </div> -->

        <!-- <div>
            <Label label="Plans" />

            <SelectBox
                :selected="filterOptions.plans"
                v-model="filterOptions.plans"
                :options="planOptions"
            />
        </div> -->

        <!-- <div>
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
        </div> -->

        <div>
            <Label label="Status" />

            <SelectBox
                v-model="filterOptions.status"
                :options="[
                    { label: 'Success', value: 'Success' },
                    { label: 'Failed', value: 'Failed' },
                ]"
            />
        </div>

        <div>
            <Label label="From Date - To Date" />

            <Datepicker   range
                          multi-calendars
                          v-model="filterOptions.range" placeholder="Select from date and to date" />
        </div>
    </DashboardFilterContainer>
</template>
