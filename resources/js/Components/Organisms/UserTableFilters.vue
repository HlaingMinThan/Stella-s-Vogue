<script setup>
import DashboardFilterContainer from '@/Components/Common/DashboardFilterContainer.vue';
import Label from '@/Components/Atoms/Label.vue';
import Datepicker from '@/Components/Atoms/Datepicker.vue';
import Checkbox from '@/Components/Atoms/Checkbox.vue';
import SearchableSelectBox from '@/Components/Atoms/SearchableSelectBox.vue';
import { countries } from '@/Data/countries';
import { reactive, watch, ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useQueryParams } from '@/Composables/useQueryParams';

const delayedSearch = ref(null);
const activeFiltersCount = ref(0);
const filterOptions = reactive({
    nationality: usePage().props.ziggy.query?.nationality,
    dob: usePage().props.ziggy.query?.dob,
    status: usePage().props.ziggy.query?.status,
    range: usePage().props.ziggy.query?.range,
    is_pink_card_member: usePage().props.ziggy.query?.is_pink_card_member
});

const status=ref(filterOptions.status==='archived' || false,);

const {getActiveFilterQueryCount}=useQueryParams();

const getFilteredUsers = () => {
    if (delayedSearch.value) {
        clearTimeout(delayedSearch.value);
    }
    delayedSearch.value = setTimeout(() => {
        router.get(
            route('admin.users.index'),
            {
                ...usePage().props.ziggy?.query,
                nationality: filterOptions.nationality,
                dob: filterOptions.dob,
                status: filterOptions.status,
                range: filterOptions.range,
                is_pink_card_member: filterOptions.is_pink_card_member === 'yes' ? 1 : (filterOptions.is_pink_card_member === 'no' ? 0 : undefined),
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


watch(status, (newValue) => {
    filterOptions.status = newValue ? 'archived':undefined;
});

</script>

<template>
    <DashboardFilterContainer :activeFiltersCount="activeFiltersCount">

        <div>
            <Label label="Nationality" />

            <SearchableSelectBox
                name="nationality"
                :options="countries"
                placeholder="Select Nationality"
                v-model="filterOptions.nationality"
                :selected="filterOptions.nationality"
            />
        </div>

        <div>
            <Label label="Date of Birth ( DOB )" />

            <Datepicker v-model="filterOptions.dob" placeholder="Select day of birth" />
        </div>

        <div>
            <Label label="From Date - To Date" />

            <Datepicker   range
                          multi-calendars
                          v-model="filterOptions.range" placeholder="Select from date and to date" />
        </div>

        <div class="flex gap-4 items-center">
            <div class="mt-2">
                <Label label="Pink Member" />

            </div>

            <div class="flex items-center gap-4">

                <div class="flex items-center">
                    <input
                        type="radio"
                        id="pink_card_yes"
                        value="yes"
                        v-model="filterOptions.is_pink_card_member"
                        class="form-radio text-primary focus:ring-primary border-gray-300 cursor-pointer"
                    />
                    <label for="pink_card_yes" class="ml-2 text-gray-700">Yes</label>
                </div>
                <div class="flex items-center">
                    <input
                        type="radio"
                        id="pink_card_no"
                        value="no"
                        v-model="filterOptions.is_pink_card_member"
                        class="form-radio text-primary focus:ring-primary border-gray-300 cursor-pointer"
                    />
                    <label for="pink_card_no" class="ml-2 text-gray-700">No</label>
                </div>
            </div>
        </div>


        <div>
            <div class="">
                <Checkbox label="Archived" v-model:checked="status"/>
            </div>
        </div>


    </DashboardFilterContainer>
</template>
