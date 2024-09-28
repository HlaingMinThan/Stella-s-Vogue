<template>
    <div class="h-screen info-card text-white">
        <SectionContainer
            class="flex flex-col justify-center items-start h-full xl:w-[70%] lg:w-[80%]"
        >
            <h1
                class="lg:text-6xl md:text-5xl text-4xl leading-[1.2] font-bold"
            >
                {{ title }}
            </h1>
            <p class="mt-5 mb-10">
                {{ description }}
            </p>
            <Button v-if="buttonText" :text="buttonText" />
        </SectionContainer>
    </div>
</template>
<script>
import SectionContainer from '../../Components/Common/SectionContainer.vue';
import Button from '../../Components/Atoms/Button.vue';
export default {
    components: {
        SectionContainer,
        Button,
    },
    props: {
        title: {
            type: String,
        },
        description: {
            type: String,
        },
        buttonText: {
            type: String,
        },
    },
};
</script>
<style></style>
