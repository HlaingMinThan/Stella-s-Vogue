<template>
    <div class="relative overflow-hidden w-full font-roboto">
        <!-- Slider Wrapper -->
        <div
            class="flex transition-opacity duration-1000 ease-in-out h-full"
            :class="{ 'opacity-0': !isVisible, 'opacity-100': isVisible }"
            :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
        >
            <div
                v-for="(item, index) in items"
                :key="index"
                class="flex-shrink-0 w-full h-[60vh] sm:h-[80vh] md:h-screen bg-cover bg-center transition-all duration-1000 ease-in-out"
                :class="{ 'opacity-0': currentIndex !== index, 'opacity-100': currentIndex === index }"
                :style="{ backgroundImage: `url(${item.image})` }"
            >
                <!-- Content Overlay -->
                <div class="relative flex items-center justify-start h-full bg-black bg-opacity-50 text-white p-6 sm:p-12 md:p-20">
                    <div class="space-y-6 sm:space-y-8 md:space-y-10 max-w-[90%] md:max-w-[700px]">
                        <div class="space-y-2 sm:space-y-4 md:space-y-6">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-primary transition-opacity duration-1000 ease-in-out"
                                :class="{ 'opacity-0': !isVisible, 'opacity-100': isVisible }">
                                Thai Legal Protection
                            </h3>
                            <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold transition-opacity duration-1000 ease-in-out"
                                :class="{ 'opacity-0': !isVisible, 'opacity-100': isVisible }">
                                {{ item.title }}
                            </h2>
                        </div>
                        <p class="text-md sm:text-base md:text-lg font-medium transition-opacity duration-1000 ease-in-out "
                           :class="{ 'opacity-0': !isVisible, 'opacity-100': isVisible }">
                            {{ item.description }}
                        </p>
                        <InertiaLinkButton :href="item.href" class="font-bold py-2 sm:py-3 px-4 sm:px-6 text-md bg-primary text-white transition-opacity duration-1000 ease-in-out"
                                           :class="{ 'opacity-0': !isVisible, 'opacity-100': isVisible }">
                            {{ item.buttonText }}
                        </InertiaLinkButton>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next and Prev Buttons -->
        <button @click="prevSlide" class="hidden w-8 h-8 md:w-12  md:h-12 md:flex items-center justify-center absolute top-1/2 left-4 transform -translate-y-1/2 bg-black bg-opacity-60 text-white p-2 rounded-full z-10">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <button @click="nextSlide" class="hidden md:w-12 w-8 h-8 md:h-12 md:flex items-center justify-center absolute top-1/2 right-24 transform -translate-y-1/2 bg-black bg-opacity-60 text-white p-2 rounded-full z-10">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <!-- Pagination Dots -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
            <span
                v-for="(item, index) in items"
                :key="index"
                @click="goToSlide(index)"
                class="w-6 h-1.5 bg-white rounded-sm cursor-pointer"
                :class="{ 'bg-opacity-70': currentIndex === index, 'bg-opacity-30': currentIndex !== index }"
            ></span>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import InertiaLinkButton from '@/Components/Atoms/InertiaLinkButton.vue';

const props = defineProps({
    items: {
        type: Array,
        required: true
    }
});

const currentIndex = ref(0);
const isVisible = ref(true);
let intervalId = null;

const startCarousel = () => {
    intervalId = setInterval(() => {
        isVisible.value = false;

        setTimeout(() => {
            currentIndex.value = (currentIndex.value + 1) % props.items.length;
            isVisible.value = true;
        }, 600); // Matches the fade-out duration for both image and text
    }, 6000); // 5.4 seconds interval + 0.6 second for transition
};

const stopCarousel = () => {
    clearInterval(intervalId);
};

const resetCarousel = () => {
    stopCarousel();
    startCarousel();
};

const nextSlide = () => {
    isVisible.value = false;
    stopCarousel();
    setTimeout(() => {
        currentIndex.value = (currentIndex.value + 1) % props.items.length;
        isVisible.value = true;
        resetCarousel();
    }, 600);
};

const prevSlide = () => {
    isVisible.value = false;
    stopCarousel();
    setTimeout(() => {
        currentIndex.value = (currentIndex.value - 1 + props.items.length) % props.items.length;
        isVisible.value = true;
        resetCarousel();
    }, 600);
};

const goToSlide = (index) => {
    if (index !== currentIndex.value) {
        isVisible.value = false;
        stopCarousel();
        setTimeout(() => {
            currentIndex.value = index;
            isVisible.value = true;
            resetCarousel();
        }, 600);
    }
};

onMounted(() => {
    startCarousel();
});

onUnmounted(() => {
    stopCarousel();
});
</script>
