<script setup>
import DashboardFilterContainer from '@/Components/Common/DashboardFilterContainer.vue';
import Label from '@/Components/Atoms/Label.vue';
import Datepicker from '@/Components/Atoms/Datepicker.vue';
import { reactive, watch, ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useQueryParams } from '@/Composables/useQueryParams';

const delayedSearch = ref(null);
const activeFiltersCount = ref(0);
const filterOptions = reactive({
    range: usePage().props.ziggy.query?.range,
});

const {getActiveFilterQueryCount}=useQueryParams();

const getFilteredUsers = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(
            route('admin.email-histories.index'),
            {
                ...usePage().props.ziggy?.query,
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

onMounted(() =>activeFiltersCount.value=getActiveFilterQueryCount());

</script>

<template>
    <DashboardFilterContainer :activeFiltersCount="activeFiltersCount">
        <div>
            <Label label="From Date - To Date ( Email Sent Date )" />

            <Datepicker   range
                          multi-calendars
                          v-model="filterOptions.range" placeholder="Select from date and to date" />
        </div>
    </DashboardFilterContainer>
</template>
