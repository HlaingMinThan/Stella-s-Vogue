<script setup>
import {computed} from 'vue';
import Label from '@/Components/Atoms/Label.vue';
import InputField from '@/Components/Atoms/InputField.vue';
import Textarea from '@/Components/Atoms/Textarea.vue';

const props=defineProps({feedback:Object});

const computedFeedback=computed(()=>props.feedback);
</script>

<template>
    <div class="text-darkGray min-w-full space-y-5">
        <h1 class="font-bold text-lg text-darkGray text-center">Thai Legal Protection Survey Report</h1>

        <div class="space-y-5">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <Label label="Member Name" />

                    <InputField
                        v-model="computedFeedback.user.name"
                        type="text"
                        disabled
                    />
                </div>
                <div>
                    <Label label="Lawyer Name" />

                    <InputField
                        v-model="computedFeedback.lawyer.name"
                        type="text"
                        disabled
                    />
                </div>
            </div>
            <!-- Question 1 -->
            <div>
                <div class="space-y-3">
                    <h3 class="font-semibold text-md">
                        1. Did the lawyer return your phone calls and/or emails promptly?
                    </h3>
                    <div class="flex justify-start items-center ml-3">
                        <template v-for="star in 5" :key="star">
                            <input
                                :id="`lawyer_response_rating-${star}`"
                                type="radio"
                                class="hidden"
                                name="lawyer_response_rating"
                                :value="star"
                                v-model="computedFeedback.lawyer_response_rating"
                                disabled
                            />
                            <label
                                :for="`lawyer_response_rating-${star}`"
                                :class="{'text-yellow-500': star <= computedFeedback.lawyer_response_rating, 'text-gray-300': star > computedFeedback.lawyer_response_rating}"
                                class="mx-1 cursor-pointer"
                            >
                                <svg
                                    class="flex-shrink-0 w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                    />
                                </svg>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div>
                <div class="space-y-3">
                    <h3 class="font-semibold text-md">
                        2. Based on your experience, were you satisfied that the lawyer was courteous, polite, and respectful?
                    </h3>
                    <div class="flex justify-start items-center ml-3">
                        <template v-for="star in 5" :key="star">
                            <input
                                :id="`lawyer_courtesy_rating-${star}`"
                                type="radio"
                                class="hidden"
                                name="lawyer_courtesy_rating"
                                :value="star"
                                v-model="computedFeedback.lawyer_courtesy_rating"
                                disabled
                            />
                            <label
                                :for="`lawyer_courtesy_rating-${star}`"
                                :class="{'text-yellow-500': star <= computedFeedback.lawyer_courtesy_rating, 'text-gray-300': star > computedFeedback.lawyer_courtesy_rating}"
                                class="mx-1 cursor-pointer"
                            >
                                <svg
                                    class="flex-shrink-0 w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                    />
                                </svg>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div>
                <div class="space-y-3">
                    <h3 class="font-semibold text-md">
                        3. Was the consultant knowledgeable in your area of concern and did they understand your problem?
                    </h3>
                    <div class="flex justify-start items-center ml-3">
                        <template v-for="star in 5" :key="star">
                            <input
                                :id="`consultant_knowledge_rating-${star}`"
                                type="radio"
                                class="hidden"
                                name="consultant_knowledge_rating"
                                :value="star"
                                v-model="computedFeedback.consultant_knowledge_rating"
                                disabled
                            />
                            <label
                                :for="`consultant_knowledge_rating-${star}`"
                                :class="{'text-yellow-500': star <= computedFeedback.consultant_knowledge_rating, 'text-gray-300': star > computedFeedback.consultant_knowledge_rating}"
                                class="mx-1 cursor-pointer"
                            >
                                <svg
                                    class="flex-shrink-0 w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                    />
                                </svg>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div>
                <div class="space-y-3">
                    <h3 class="font-semibold text-md">
                        4. How satisfied were you with the outcome of your consultation with the lawyer?
                    </h3>
                    <div class="flex justify-start items-center ml-3">
                        <template v-for="star in 5" :key="star">
                            <input
                                :id="`consultation_outcome_rating-${star}`"
                                type="radio"
                                class="hidden"
                                name="consultation_outcome_rating"
                                :value="star"
                                v-model="computedFeedback.consultation_outcome_rating"
                                disabled
                            />
                            <label
                                :for="`consultation_outcome_rating-${star}`"
                                :class="{'text-yellow-500': star <= computedFeedback.consultation_outcome_rating, 'text-gray-300': star > computedFeedback.consultation_outcome_rating}"
                                class="mx-1 cursor-pointer"
                            >
                                <svg
                                    class="flex-shrink-0 w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                    />
                                </svg>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div>
                <div class="space-y-3">
                    <h3 class="font-semibold text-md">
                        5. Did the consultant return your phone calls and/or emails promptly?
                    </h3>
                    <div class="flex justify-start items-center ml-3">
                        <template v-for="star in 5" :key="star">
                            <input
                                :id="`consultant_response_rating-${star}`"
                                type="radio"
                                class="hidden"
                                name="consultant_response_rating"
                                :value="star"
                                v-model="computedFeedback.consultant_response_rating"
                                disabled
                            />
                            <label
                                :for="`consultant_response_rating-${star}`"
                                :class="{'text-yellow-500': star <= computedFeedback.consultant_response_rating, 'text-gray-300': star > computedFeedback.consultant_response_rating}"
                                class="mx-1 cursor-pointer"
                            >
                                <svg
                                    class="flex-shrink-0 w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                    />
                                </svg>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Question 6 -->
            <div>
                <div class="space-y-3">
                    <h3 class="font-semibold text-md">
                        6. Was the lawyer knowledgeable in your area of concern and did they understand your problem?
                    </h3>
                    <div class="flex justify-start items-center ml-3">
                        <template v-for="star in 5" :key="star">
                            <input
                                :id="`lawyer_knowledge_rating-${star}`"
                                type="radio"
                                class="hidden"
                                name="lawyer_knowledge_rating"
                                :value="star"
                                v-model="computedFeedback.lawyer_knowledge_rating"
                                disabled
                            />
                            <label
                                :for="`lawyer_knowledge_rating-${star}`"
                                :class="{'text-yellow-500': star <= computedFeedback.lawyer_knowledge_rating, 'text-gray-300': star > computedFeedback.lawyer_knowledge_rating}"
                                class="mx-1 cursor-pointer"
                            >
                                <svg
                                    class="flex-shrink-0 w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                    />
                                </svg>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Question 7 -->
            <div>
                <h3 class="font-semibold text-md">
                    7. Is there anything else you would like to share with us regarding your experience?
                </h3>

                <div class="space-y-3 mt-4">
                    <!-- Radio Options -->
                    <div>
                        <input
                            type="radio"
                            class="mr-2 text-primary focus:ring-primary border border-gray-400"
                            checked
                            disabled
                        />
                        <label class="font-medium text-darkGray">{{ computedFeedback.feedback_area }}</label>
                    </div>
                </div>

                <div v-if="computedFeedback.feedback_area === 'Other'" class="mt-4">
                    <Label label="Please specify:" />

                    <Textarea v-model="computedFeedback.other_area"  disabled/>

                </div>
            </div>

            <!-- Question 8 -->
            <div>
                <h3 class="font-semibold text-md">
                    8. From your previous selection, please provide any additional comments about your Thai Legal Protection experience in the box below:
                </h3>

                <div  class="mt-4">
                    <p v-if="computedFeedback.additional_comments" class="font-semibold text-sm text-darkGray">
                        {{ computedFeedback.additional_comments}}
                    </p>
                    <p v-else  class="font-semibold text-sm text-gray-500">
                        No Additional Comment From Member
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
