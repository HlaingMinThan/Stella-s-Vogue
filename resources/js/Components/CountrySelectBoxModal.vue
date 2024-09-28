<template>
    <div class="fixed z-[100] top-0 left-0 w-full h-full bg-[rgba(0,0,0,0.75)] items-center justify-center px-5" :class="[isRegionModalBoxOpen ? 'flex' : 'hidden' ]">
        <div data-cy="country-select-modal" class="lg:w-[40%] md:w-[60%] bg-white py-7 text-center md:px-10 px-5 rounded-lg">
            <p>Our Legal Plans are available in</p>
            <h1 class="text-lg font-semibold mt-1 leading-[1.1]">Thailand, Myanmar, Laos, Combodia and many other countries</h1>
            <p class="pt-3 w-[90%] mx-auto">To continue, please select your desired province from the dropdown menu:
            </p>
            <div class="relative my-5">
                <SearchableSelectBox
                    data-cy="user-country-select-box"
                    name="nationality"
                    :options="countries"
                    placeholder="Select Nationality"
                    :selected="region"
                    @change="handleNationality"
                />
            </div>

            <div class="flex items-center justify-end">
                <NormalButton data-cy="update-region-btn" class="text-sm bg-primary text-white" @click="updateRegion" :disabled="!region">
                    <div>Update Region <i class="fa-solid fa-arrow-right ml-1.5"></i></div>
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M16.01 11H5c-.55 0-1 .45-1 1s.45 1 1 1h11.01v1.79c0 .45.54.67.85.35l2.78-2.79c.19-.2.19-.51 0-.71l-2.78-2.79c-.31-.32-.85-.09-.85.35z"/></svg> -->
                </NormalButton>
            </div>
        </div>
    </div>
</template>
<script>
import SearchableSelectBox from '@/Components/Atoms/SearchableSelectBox.vue';
import { countries } from '@/Data/countries';
import { mapGetters, mapMutations } from 'vuex';
import NormalButton from '@/Components/Atoms/NormalButton.vue';
export default {
    components : {
        SearchableSelectBox,
        NormalButton
    },
    data(){
        return {
            countries,
            region : 'Thailand'
        };
    },
    computed:{
        ...mapGetters(['isRegionModalBoxOpen'])
    },

    methods : {
        ...mapMutations(['toggleRegionModalBox','nationality']),
        handleNationality(option){
            this.region = option?.name;
            localStorage.setItem('isoCode',option?.isoCode.toLowerCase());
        },
        updateRegion(){
            localStorage.setItem('region',this.region);
            this.nationality(this.region);
            this.toggleRegionModalBox(false);
        }
    },


    mounted() {
        const thailand = this.countries.find(country => country.name === 'Thailand');
        if (thailand) {
            this.region = thailand.name;
            localStorage.setItem('isoCode', thailand.isoCode.toLowerCase());
        }
    },
};
</script>
