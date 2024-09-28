<script setup>
import Label from '@/Components/Atoms/Label.vue';
import InputField from '@/Components/Atoms/InputField.vue';
// import Textarea from '@/Components/Atoms/Textarea.vue';
import {computed} from 'vue';

const props=defineProps({termAndCondition:Object});

const computedTermAndCondition=computed(()=>props.termAndCondition);
</script>

<template>
    <div class="text-darkGray min-w-full space-y-5">
        <h1 class="font-bold text-lg text-darkGray text-center">Terms And Conditions</h1>

        <div>
            <Label label="Title" />

            <InputField
                v-model="computedTermAndCondition.title"
                type="text"
                disabled
            />
        </div>

        <div>
            <Label label="Description" />

            <div v-html="computedTermAndCondition.description" class="block w-full p-3.5 rounded-md  bg-gray-50 outline-none transition-all disabled:cursor-not-allowed focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400">

            </div>

            <!-- <Textarea
                v-model=""
                :rows="10"
                disabled
            /> -->
        </div>

        <!-- <div>
            <Label label="Type" />

            <InputField
                v-model="computedTermAndCondition.type"
                type="text"
                disabled
            />
        </div> -->
    </div>
</template>
