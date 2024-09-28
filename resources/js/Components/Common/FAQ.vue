<template>
    <div class="border-t-[1px] border-gray-300 py-7 px-5">
        <div class="flex item-center md:gap-0 gap-5 justify-between">
            <h1 class="font-medium text-lg">
                {{ FAQ.question }}
            </h1>
            <svg
                :class="FAQ.isOpen ? 'rotate-180' : ''"
                class="transition-all shrink-0"
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="32"
                viewBox="0 0 24 24"
            >
                <path
                    fill="currentColor"
                    d="m12 15.4l-6-6L7.4 8l4.6 4.6L16.6 8L18 9.4z"
                />
            </svg>
        </div>
        <div
            :class="[
                FAQ.isOpen ? 'h-auto scale-y-1 pt-7' : 'h-0 scale-y-[0.2]',
            ]"
            class="overflow-hidden transition-all"
        >
            <p v-html="FAQ.answer"></p>
            <!-- {{ FAQ.answer }} -->
        </div>
    </div>
</template>
<script>
export default {
    props: {
        FAQ: {
            type: Object,
            required: true,
        },
    },
};
</script>
<style></style>
