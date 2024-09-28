<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import ReviewCard from '@/Components/Atoms/ReviewCard.vue';

const props = defineProps({
    reviews: Array,
});

const reviews = ref(props.reviews);

let defaultTransform = ref(0);
const itemWidth = ref(0); // Dynamic item width for calculations
const visibleCards = ref(3); // Default to 3 visible cards for large screens

// Calculate how many cards should be visible based on the screen size
const calculateVisibleCards = () => {
    if (window.innerWidth >= 1440) { // For screens 1440px and above
        visibleCards.value = 3;
    } else if (window.innerWidth >= 1024) { // For screens between 1024px and 1439px
        visibleCards.value = 2;
    } else { // For screens less than 1024px (including 768px and below)
        visibleCards.value = 1;
    }
};

// Get the width of each card based on the visible cards and padding
const getCardWidth = () => {
    calculateVisibleCards();
    const containerPadding = getContainerPadding(); // Get the padding based on screen size
    const availableWidth = window.innerWidth - containerPadding; // Subtract horizontal padding from inner width

    // Calculate the gap dynamically
    const gap = (visibleCards.value === 1) ? 0 : 20; // No gap if there's only one card

    return (availableWidth - gap * (visibleCards.value - 1)) / visibleCards.value; // Account for gaps between cards
};

// Function to calculate the total horizontal padding (left + right)
const getContainerPadding = () => {
    let padding;
    if (window.innerWidth >= 1024) { // Large screens (md:p-16 => px-16 on both sides)
        padding = 32 * 2; // 32px on each side (16 rem -> px = 32)
    } else if (window.innerWidth >= 768) { // Medium screens (md:p-16 => px-16 on both sides)
        padding = 32 * 2; // 32px on each side (16 rem -> 16px)
    } else { // Small screens (px-4 => 16px padding on both sides)
        padding = 16 * 2; // 16px on each side (4 rem -> 4px)
    }
    return padding; // Total horizontal padding (left + right)
};


// Move carousel next by card width
const goNext = () => {
    const reviewCarousel = document.getElementById('review-carousel');
    if (reviewCarousel) {
        const maxTranslate = -(reviewCarousel.scrollWidth - reviewCarousel.clientWidth);
        defaultTransform.value -= itemWidth.value;
        if (defaultTransform.value <= maxTranslate) {
            defaultTransform.value = maxTranslate; // Don't move beyond maxTranslate
        }
        reviewCarousel.style.transform = 'translateX(' + defaultTransform.value + 'px)';
    }
};

// Move carousel prev by card width
const goPrev = () => {
    const reviewCarousel = document.getElementById('review-carousel');
    if (reviewCarousel) {
        defaultTransform.value += itemWidth.value;
        if (defaultTransform.value > 0) {
            defaultTransform.value = 0; // Don't move beyond the first item
        }
        reviewCarousel.style.transform = 'translateX(' + defaultTransform.value + 'px)';
    }
};

// Auto-slide functionality
const autoSlideInterval = ref(null);

const startAutoSlide = () => {
    autoSlideInterval.value = setInterval(() => {
        goNext();
    }, 3000); // Slide every 3 seconds
};

const stopAutoSlide = () => {
    if (autoSlideInterval.value) {
        clearInterval(autoSlideInterval.value);
    }
};

onMounted(() => {
    itemWidth.value = getCardWidth();
    startAutoSlide();
});

onBeforeUnmount(() => {
    stopAutoSlide();
});

window.addEventListener('resize', () => {
    itemWidth.value = getCardWidth();
});
</script>

<template>
    <div class="relative flex items-center justify-center w-full h-full">
        <div class="w-full relative flex flex-col items-center md:items-end justify-center">

            <div class="flex items-center space-x-5 mb-3">
                <!-- Previous Button -->
                <button
                    type="button"
                    aria-label="slide backward"
                    class="border min-w-11 min-h-11 rounded-md flex items-center justify-center text-white bg-yellow-500 hover:bg-yellow-600 transition-all"
                    @click="goPrev"
                >
                    <i class="fa-solid fa-arrow-left"></i>
                </button>

                <!-- Next Button -->
                <button
                    type="button"
                    aria-label="slide forward"
                    class="border min-w-11 min-h-11 rounded-md flex items-center justify-center text-white bg-yellow-500 hover:bg-yellow-600 transition-all"
                    @click="goNext"
                >
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden rounded-md">
                <div
                    id="review-carousel"
                    :class="{
                        'justify-center': visibleCards.value === 1,
                        'justify-start': visibleCards.value > 1
                    }"
                    class="h-full flex items-center transition ease-out duration-700"
                    :style="{ gap: visibleCards.value > 1 ? '20px' : '0' }"
                >
                    <div
                        v-for="(review, index) in reviews"
                        :key="index"
                        class="flex flex-shrink-0 relative rounded-md overflow-hidden"
                        :style="{ width: itemWidth + 'px' }"
                    >
                        <ReviewCard :review="review" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
