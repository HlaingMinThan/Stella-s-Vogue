<template>

    <h1 class="text-center text-2xl font-semibold">{{ data.title }}</h1>


    <div class="my-12">
        <div class="space-y-12">
            <div v-for="(item, index) in generalFAQs" :key="index" class="space-y-6 border-b border-gray-500 pb-4">
                <h5 class="text-xl font-semibold">{{ item?.title }}</h5>

                <div class="flex justify-between items-center cursor-pointer text-sm md:text-lg text-balance"
                     @click="toggleCollapse(index)"
                >
                    <h5

                    >
                        {{ item.question }}

                    </h5>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        :class="[
                            'transition-transform duration-300',
                            collapsedIndex === index ? 'rotate-180' : '',
                            'w-6 h-6 md:w-5 md:h-5'
                        ]"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </div>
                <div
                    v-show="collapsedIndex === index"
                    :class="['overflow-auto transition-all duration-300', collapsedIndex === index ? 'max-h-[500px]' : 'max-h-0']"
                    class="mt-2"
                >
                    <div v-html="item.answer"></div>
                </div>


            </div>

        </div>
    </div>

    <div class="text-primary font-semibold space-y-2">
        <h1 class=" ">Call - <a href="tel:+66 02 251 8135" class="hover:underline">+66 02 251 8135</a></h1>
        <h1 class="">Email - <a href="mailto:info@thailegalprotection.com" class="hover:underline">info@thailegalprotection.com</a></h1>
        <h1>
            <a href="#" class="hover:underline">Chat Online</a>
        </h1>
    </div>
</template>

<script>
import { generalFAQs } from '@/Data/generalFAQ';

export default {
    props: {
        data: {
            type: Object
        }
    },
    data() {
        return {
            collapsedIndex:null,
            generalFAQs,
        };
    },
    methods: {
        toggleCollapse(index) {
            this.collapsedIndex = this.collapsedIndex === index ? null : index;
        },
    },
};
</script>

  <style scoped>
  /* Add any custom styles here */
  </style>
