<script setup>
defineProps({
    image:{
        type:String
    },
    title:{
        type:String
    },
    mainHeader:{
        type:Boolean,
        default:false
    },
    imageRight:{
        type:Boolean,
        default:true
    },
});
</script>

<template>
    <section class="p-4 md:px-16 md:py-12" :class="{'bg-gray-100':mainHeader}">
        <div class="flex flex-col md:flex-row items-start justify-between">
            <div class="w-full md:w-1/2 p-5 space-y-8"
                 :class="{'md:order-1':imageRight}"
            >
                <div class="rounded-lg w-full h-full overflow-hidden">
                    <img :src="image" alt="image" class="object-contain w-full h-full">
                </div>
            </div>
            <div class="w-full md:w-1/2 p-5 space-y-6">
                <h1 class="w-full lg:text-5xl text-4xl text-center md:text-left leading-[1.2] font-bold text-darkGray"
                    :class="{'block':title,'hidden':!title}"
                >
                    {{title}}
                </h1>
                <div class="w-full font-medium text-lg md:text-xl text-darkGray text-center md:text-left">
                    <slot name="content" />
                </div>

                <div class="flex items-center justify-center md:justify-start">

                    <slot name="button" />
                </div>

                <!-- <InertiaLinkButton :href="route('how-we-work')" class="bg-primary text-white">
                    Learn More
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </InertiaLinkButton> -->
            </div>
        </div>
    </section>
</template>
