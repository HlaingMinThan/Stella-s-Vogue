<template>
    <div class="bg-white rounded-lg cursor-pointer shadow-card px-8 py-10">
        <component
            :is="icon"
            :width="iconWidth"
            :height="iconHeight"
        ></component>
        <h1 class="lg:text-4xl md:text-3xl text-xl font-bold mt-5">
            {{ title }}
        </h1>
        <p v-if="description" class="pt-8">{{ description }}</p>
        <Link

            :href="route('get-started')"
            class="flex items-center text-primary font-bold text-lg gap-2 mt-16"
        >
            <p class="hover:underline underline-primary">Learn more</p>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="22"
                height="22"
                viewBox="0 0 24 24"
            >
                <path
                    fill="currentColor"
                    d="M16.15 13H5q-.425 0-.712-.288T4 12t.288-.712T5 11h11.15L13.3 8.15q-.3-.3-.288-.7t.288-.7q.3-.3.713-.312t.712.287L19.3 11.3q.15.15.213.325t.062.375t-.062.375t-.213.325l-4.575 4.575q-.3.3-.712.288t-.713-.313q-.275-.3-.288-.7t.288-.7z"
                />
            </svg>
        </Link>
    </div>
</template>
<script>
import {Link} from '@inertiajs/vue3';

export default {
    components:{
        Link
    },
    props: {
        icon: {
            type: Object,
        },
        description: {
            type: String,
        },
        title: {
            type: String,
        },
        iconWidth: {
            type: String,
            default: '112',
        },
        iconHeight: {
            type: String,
            default: '112',
        },
    },
};
</script>
