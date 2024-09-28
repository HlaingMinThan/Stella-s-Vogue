<script setup>
import Label from '@/Components/Atoms/Label.vue';
import InputField from '@/Components/Atoms/InputField.vue';
import Textarea from '@/Components/Atoms/Textarea.vue';
import {computed} from 'vue';
import RatingStars from '@/Components/Atoms/RatingStars.vue';

const props=defineProps({review:Object});

const computedReview=computed(()=>props.review);
</script>

<template>
    <div class="text-darkGray min-w-full space-y-5">
        <h1 class="font-bold text-lg text-darkGray text-center">Customer Review</h1>

        <div class="flex items-center">
            <p class="text-left block text-sm font-bold text-darkGray">Rating &nbsp; -  &nbsp;</p>
            <div class="flex items-center space-x-3">
                <RatingStars :rating="review.rating"/> <p class="font-bold text-xs text-gray-700">( {{ review.rating }} out of 5 )</p>
            </div>
        </div>

        <div>
            <Label label="Reviewer Name" />

            <InputField
                v-model="computedReview.name"
                type="text"
                disabled
            />
        </div>

        <div>
            <Label label="Review Comment" />

            <Textarea
                v-model="computedReview.comment"
                disabled
            />
        </div>

        <div>
            <Label label="Review At" />

            <InputField
                v-model="computedReview.created_at"
                type="text"
                disabled
            />
        </div>

    </div>
</template>
