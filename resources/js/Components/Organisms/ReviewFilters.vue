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
    rating: usePage().props.ziggy.query?.rating,
});

const { getActiveFilterQueryCount } = useQueryParams();

const getFilteredUsers = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(
            route('admin.reviews.index'),
            {
                ...usePage().props.ziggy?.query,
                rating: filterOptions.rating,
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
            <Label label="Ratings" />

            <SelectBox
                :selected="filterOptions.rating"
                v-model="filterOptions.rating"
                :options="[
                    { label: '1 Star Rating', value: '1' },
                    { label: '2 Stars Rating', value: '2' },
                    { label: '3 Stars Rating', value: '3' },
                    { label: '4 Stars Rating', value: '4' },
                    { label: '5 Stars Rating', value: '5' },
                ]"
            />
        </div>
    </DashboardFilterContainer>
</template>
