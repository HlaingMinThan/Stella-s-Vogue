<template>
    <!-- <div class="max-w-sm overflow-hidden shadow-lg mt-12 lg:w-[calc(33.333%-1rem)]"> -->
    <!-- <div class="overflow-hidden border border-gray-300 mt-10 rounded-xl">

        <img
            :src="image"
            :class="[defaultStyle, style]"
            alt="Blog image"
            class="w-full object-cover pt-3 rounded"
        />
        <div class="px-3 py-2">
            <h2 class="my-2 prose blog-description" v-html="description"></h2>
        </div>
        <div class="px-3 pt-4 pb-4 mx-auto">
            <span
                v-for="tag in tags" :key="tag.id"
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ tag.title }}</span>

        </div>
    </div> -->


    <Link :href="route('resources.blog-detail', { title })" class=" w-full rounded-lg overflow-hidden">
        <img
            :src="image"
            :class="[defaultStyle, style]"
            alt="Blog image"
            class="w-full object-cover pt-3 rounded-lg"
        />
        <div class=" py-2">
            <div class="font-bold text-xl">
                <h2 class="my-2 prose" v-html="title"></h2>
            </div>
            <!-- <p class="text-gray-700 text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
            </p> -->
        </div>
        <div class=" pb-2">
            <span
                v-for="tag in tags" :key="tag.id"
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ tag.title }}</span>
        </div>
    </Link>
</template>




<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link
    },

    props: {
        image: {
            type: String
        },
        title: {
            type: String
        },
        description: {
            type: String
        },
        tags: {
            type: Array
        },
        about: {
            type: String
        },
        date: {
            type: String
        },
        style: {
            type: String,
            default: ''
        }
    },
    computed: {
        defaultStyle() {
            return 'w-full object-cover rounded';
        }
    },



};
</script>

<style scoped>
.blog-description {
    @apply h-28 overflow-hidden text-ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
}
</style>
