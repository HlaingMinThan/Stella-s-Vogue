<script setup>
import DashboardFilterContainer from '@/Components/Common/DashboardFilterContainer.vue';
import Label from '@/Components/Atoms/Label.vue';
import SelectBox from '@/Components/Atoms/SelectBox.vue';
import Datepicker from '@/Components/Atoms/Datepicker.vue';
import { reactive, watch, ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useQueryParams } from '@/Composables/useQueryParams';

const delayedSearch = ref(null);
const activeFiltersCount = ref(0);
const filterOptions = reactive({
    lawyer_response_rating: usePage().props.ziggy.query?.lawyer_response_rating,
    lawyer_courtesy_rating: usePage().props.ziggy.query?.lawyer_courtesy_rating,
    consultant_knowledge_rating: usePage().props.ziggy.query?.consultant_knowledge_rating,
    consultation_outcome_rating: usePage().props.ziggy.query?.consultation_outcome_rating,
    consultant_response_rating: usePage().props.ziggy.query?.consultant_response_rating,
    lawyer_knowledge_rating: usePage().props.ziggy.query?.lawyer_knowledge_rating,
    range: usePage().props.ziggy.query?.range,
});

const {getActiveFilterQueryCount}=useQueryParams();

const getFilteredUsers = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(
            route('admin.feedbacks.index'),
            {
                ...usePage().props.ziggy?.query,
                lawyer_response_rating: filterOptions.lawyer_response_rating,
                lawyer_courtesy_rating: filterOptions.lawyer_courtesy_rating,
                consultant_knowledge_rating: filterOptions.consultant_knowledge_rating,
                consultation_outcome_rating: filterOptions.consultation_outcome_rating,
                consultant_response_rating: filterOptions.consultant_response_rating,
                lawyer_knowledge_rating: filterOptions.lawyer_knowledge_rating,
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
            <Label label="Lawyer Response Rating" />

            <SelectBox
                :selected="filterOptions.lawyer_response_rating"
                v-model="filterOptions.lawyer_response_rating"
                :options="[
                    { label: '1 Star Rating', value: '1' },
                    { label: '2 Stars Rating', value: '2' },
                    { label: '3 Stars Rating', value: '3' },
                    { label: '4 Stars Rating', value: '4' },
                    { label: '5 Stars Rating', value: '5' },
                ]"
            />
        </div>

        <div>
            <Label label="Lawyer Courtesy Rating" />

            <SelectBox
                :selected="filterOptions.lawyer_courtesy_rating"
                v-model="filterOptions.lawyer_courtesy_rating"
                :options="[
                    { label: '1 Star Rating', value: '1' },
                    { label: '2 Stars Rating', value: '2' },
                    { label: '3 Stars Rating', value: '3' },
                    { label: '4 Stars Rating', value: '4' },
                    { label: '5 Stars Rating', value: '5' },
                ]"
            />
        </div>

        <div>
            <Label label="Consultant Knowledge Rating" />

            <SelectBox
                :selected="filterOptions.consultant_knowledge_rating"
                v-model="filterOptions.consultant_knowledge_rating"
                :options="[
                    { label: '1 Star Rating', value: '1' },
                    { label: '2 Stars Rating', value: '2' },
                    { label: '3 Stars Rating', value: '3' },
                    { label: '4 Stars Rating', value: '4' },
                    { label: '5 Stars Rating', value: '5' },
                ]"
            />
        </div>

        <div>
            <Label label="Consultation Outcome Rating" />

            <SelectBox
                :selected="filterOptions.consultation_outcome_rating"
                v-model="filterOptions.consultation_outcome_rating"
                :options="[
                    { label: '1 Star Rating', value: '1' },
                    { label: '2 Stars Rating', value: '2' },
                    { label: '3 Stars Rating', value: '3' },
                    { label: '4 Stars Rating', value: '4' },
                    { label: '5 Stars Rating', value: '5' },
                ]"
            />
        </div>

        <div>
            <Label label="Consultant Response Rating" />

            <SelectBox
                :selected="filterOptions.consultant_response_rating"
                v-model="filterOptions.consultant_response_rating"
                :options="[
                    { label: '1 Star Rating', value: '1' },
                    { label: '2 Stars Rating', value: '2' },
                    { label: '3 Stars Rating', value: '3' },
                    { label: '4 Stars Rating', value: '4' },
                    { label: '5 Stars Rating', value: '5' },
                ]"
            />
        </div>

        <div>
            <Label label="Lawyer Knowledge Rating" />

            <SelectBox
                :selected="filterOptions.lawyer_knowledge_rating"
                v-model="filterOptions.lawyer_knowledge_rating"
                :options="[
                    { label: '1 Star Rating', value: '1' },
                    { label: '2 Stars Rating', value: '2' },
                    { label: '3 Stars Rating', value: '3' },
                    { label: '4 Stars Rating', value: '4' },
                    { label: '5 Stars Rating', value: '5' },
                ]"
            />
        </div>

        <div>
            <Label label="From Date - To Date ( Email Sent Date )" />

            <Datepicker   range
                          multi-calendars
                          v-model="filterOptions.range" placeholder="Select from date and to date" />
        </div>
    </DashboardFilterContainer>
</template>
