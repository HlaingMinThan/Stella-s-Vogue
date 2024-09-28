<script setup>
import DashboardFilterContainer from '@/Components/Common/DashboardFilterContainer.vue';
import Label from '@/Components/Atoms/Label.vue';
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import { reactive, ref, watch, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useQueryParams } from '@/Composables/useQueryParams';

const props = defineProps({
    categories: {
        type: Array,
        required: true
    }
});

const delayedSearch = ref(null);
const activeFiltersCount = ref(0);
const filterOptions = reactive({
    category: usePage().props.ziggy.query?.category_id || null,
    search: usePage().props.ziggy.query?.search || ''
});

const { getActiveFilterQueryCount } = useQueryParams();

const getFilteredBlogs = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(
            route('admin.blogs.index'),
            {
                ...usePage().props.ziggy?.query,
                search: filterOptions.search,
                category_id: filterOptions.category,
            },
            {
                replace: true,
                preserveState: true,
                onSuccess: () => {
                    activeFiltersCount.value = getActiveFilterQueryCount();
                },
            }
        );
    }, 500);
};

watch(filterOptions, () => getFilteredBlogs());

onMounted(() => {
    activeFiltersCount.value = getActiveFilterQueryCount();
});

</script>

<template>
    <DashboardFilterContainer :activeFiltersCount="activeFiltersCount">
        <div>
            <Label label="Category" />
            <SelectBox
                :selected="filterOptions.category"
                v-model="filterOptions.category"
                :options="props.categories.map(category => ({ label: category.name, value: category.id }))"
            />
        </div>
    </DashboardFilterContainer>
</template>
