<script setup>
import DashboardFilterContainer from '@/Components/Common/DashboardFilterContainer.vue';
import Label from '@/Components/Atoms/Label.vue';
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import { reactive, watch, ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useQueryParams } from '@/Composables/useQueryParams';

const delayedSearch = ref(null);
const activeFiltersCount = ref(0);
const filterOptions = reactive({
    category: usePage().props.ziggy.query?.category,
    status: usePage().props.ziggy.query?.status,
});

const { getActiveFilterQueryCount } = useQueryParams();

const getFilteredUsers = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(
            route('admin.tickets.index'),
            {
                ...usePage().props.ziggy?.query,
                category: filterOptions.category,
                status: filterOptions.status,
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
        <div>
            <Label label="Category" />

            <SelectBox
                :selected="filterOptions.category"
                v-model="filterOptions.category"
                :options="[
                    { label: 'Billing', value: 'billing' },
                    { label: 'Technical Support', value: 'technical support' },
                    { label: 'Legal Support', value: 'legal support' },
                ]"
            />
        </div>

        <div>
            <Label label="Status" />

            <SelectBox
                :selected="filterOptions.status"
                v-model="filterOptions.status"
                :options="[
                    { label: 'Pending', value: 'pending' },
                    { label: 'Resolving', value: 'resolving' },
                    { label: 'Completed', value: 'completed' },
                ]"
            />
        </div>
    </DashboardFilterContainer>
</template>
