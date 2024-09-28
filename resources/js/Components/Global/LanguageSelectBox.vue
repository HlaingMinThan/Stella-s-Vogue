<script setup>
import { ref } from 'vue';
import { createToaster } from '@meforma/vue-toaster';

const toast = createToaster();
const selectedLanguage = ref(window.crestStub?.getCurrentLanguage()||'en-US');
const languageOptions=ref([
    {label:'English',value:'en-US'} ,
    {label:'Thai',value:'th-TH'},
    {label:'Chinese',value:'zh-CN'},
]);

const changeLanguage = async (event) => {
    try {
        selectedLanguage.value = event.target.value;

        const result = await window.crestStub?.setCurrentLanguage(selectedLanguage.value);

        if (!result) {
            throw new Error('Failed to set language. Please try again.');
        }
    } catch (error) {
        toast.error(error);
    }
};

</script>

<template>
    <select
        id="languageSelect"
        name="language"
        class="w-full h-full text-sm  focus:ring-0 cursor-pointer focus:outline-none font-medium border-neutral-700 focus:border-neutral-700 rounded-md bg-transparent"
        @change="changeLanguage($event)"
        v-model="selectedLanguage"
    >
        <option
            :value="language.value"
            v-for="language in languageOptions"
            :key="language.value"
            :selected="language.value === selectedLanguage"
            class="py-2"
        >
            {{ language.label }}
        </option>
    </select>
</template>
