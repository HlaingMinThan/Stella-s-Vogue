<script setup>
import DashboardFilterContainer from '@/Components/Common/DashboardFilterContainer.vue';
import Label from '@/Components/Atoms/Label.vue';
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import { reactive, ref, watch, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useQueryParams } from '@/Composables/useQueryParams';


defineProps({
    types: {
        type:Array,
        require:true
    }
});

const delayedSearch = ref(null);
const activeFiltersCount = ref(0);
const filterOptions = reactive({
    type: usePage().props.ziggy.query?.type,
});

const { getActiveFilterQueryCount } = useQueryParams();

const getFilteredTerms = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(
            route('admin.terms-and-conditions.index'),
            {
                ...usePage().props.ziggy?.query,
                search: filterOptions.search,
                type: filterOptions.type,
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

watch(filterOptions, () => getFilteredTerms());

onMounted(() => activeFiltersCount.value = getActiveFilterQueryCount());

</script>

<template>
    <DashboardFilterContainer :activeFiltersCount="activeFiltersCount">
        <div>
            <Label label="Type" />
            <SelectBox
                :selected="filterOptions.type"
                v-model="filterOptions.type"
                :options="types.map(type => ({ label: type, value: type }))"
            />
        </div>
    </DashboardFilterContainer>
</template>
