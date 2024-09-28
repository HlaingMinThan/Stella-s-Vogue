<script setup>
import RatingStars from '@/Components/Atoms/RatingStars.vue';

defineProps({
    review:Object
});
</script>

<template>
    <div class="relative max-w-md border border-gray-200 mx-auto bg-white h-[350px] rounded-lg p-8 space-y-6">
        <div class="absolute top-4 left-4 opacity-40">
            <i class="fa-solid fa-quote-left text-primary text-5xl"></i>
        </div>

        <div class="pt-5">
            <p class="italic text-gray-700 text-lg font-medium leading-relaxed text-center">
                "{{review?.comment}}"
            </p>

            <div class="flex flex-col items-center space-y-2 mt-4">
                <span class="block font-bold text-lg text-darkGray">{{ review?.name }}</span>
                <RatingStars :rating="review?.rating" />
            </div>
        </div>
    </div>
</template>
